<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // user view of own transactions
    public function index(Request $request)
    {
        $transactions = $request->user()->transactions()->latest()->paginate(20);
        return view('transactions.index', compact('transactions'));
    }

    // create payment/transfer (simple transfer to another user)
    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:payment,transfer',
            'amount' => 'required|numeric|min:1',
            'target_email' => 'nullable|email',
            'notes' => 'nullable|string'
        ]);

        $user = $request->user();

        DB::transaction(function () use ($data, $user, $request) {
            $targetUser = null;
            if ($data['type'] === 'transfer') {
                $targetUser = User::where('email', $data['target_email'])->firstOrFail();
                if ($targetUser->id === $user->id) abort(400, 'Tidak bisa transfer ke diri sendiri.');
            }

            // create tx as pending/approved depending on business rules.
            // we'll auto-process transfer if user has enough balance.
            $tx = Transaction::create([
                'user_id' => $user->id,
                'type' => $data['type'],
                'amount' => $data['amount'],
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
                'target_user_id' => $targetUser->id ?? null
            ]);

            // process transfers immediately if balance allowed
            $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id, 'balance' => 0]);

            if ($data['type'] === 'transfer') {
                if ($wallet->balance >= $data['amount']) {
                    // debit sender
                    $wallet->balance -= $data['amount'];
                    $wallet->save();
                    // credit target
                    $tgtWallet = $targetUser->wallet ?? Wallet::create(['user_id' => $targetUser->id, 'balance' => 0]);
                    $tgtWallet->balance += $data['amount'];
                    $tgtWallet->save();

                    $tx->update(['status' => 'completed']);
                } else {
                    // insufficient -> leave pending / fail
                    $tx->update(['status' => 'failed']);
                    throw new \Exception('Saldo tidak cukup.');
                }
            } else {
                // payments can be processed by admin or auto depending on your rule
                // here we'll mark payment as completed and deduct from wallet if enough
                if ($wallet->balance >= $data['amount']) {
                    $wallet->balance -= $data['amount'];
                    $wallet->save();
                    $tx->update(['status' => 'completed']);
                } else {
                    $tx->update(['status' => 'failed']);
                    throw new \Exception('Saldo tidak cukup untuk membayar.');
                }
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi diproses.');
    }

    // Admin functions
    public function adminIndex()
    {
        $transactions = Transaction::latest()->paginate(30);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function approve(Request $request, $id)
    {
        $tx = Transaction::findOrFail($id);

        if ($tx->status !== 'pending') {
            return back()->with('error', 'Hanya transaksi pending bisa di-approve.');
        }

        DB::transaction(function () use ($tx) {
            // topup: credit user wallet
            if ($tx->type === 'topup') {
                $wallet = $tx->user->wallet ?? Wallet::create(['user_id' => $tx->user->id, 'balance' => 0]);
                $wallet->balance += $tx->amount;
                $wallet->save();

                $tx->update(['status' => 'approved']);
            } elseif ($tx->type === 'payment') {
                // if payment pending and admin approves, debit user's wallet
                $wallet = $tx->user->wallet ?? Wallet::create(['user_id' => $tx->user->id, 'balance' => 0]);
                if ($wallet->balance >= $tx->amount) {
                    $wallet->balance -= $tx->amount;
                    $wallet->save();
                    $tx->update(['status' => 'approved']);
                } else {
                    $tx->update(['status' => 'failed']);
                }
            }
        });

        return back()->with('success', 'Transaksi disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $tx = Transaction::findOrFail($id);
        if ($tx->status !== 'pending') {
            return back()->with('error', 'Hanya transaksi pending bisa di-reject.');
        }
        $tx->update(['status' => 'rejected']);
        return back()->with('success', 'Transaksi ditolak.');
    }
}
