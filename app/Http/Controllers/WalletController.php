<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id, 'balance' => 0]);
        return view('wallet.index', compact('wallet'));
    }

    // Create top-up request
    public function topupForm()
    {
        return view('wallet.topup');
    }

    public function topup(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1000']);
        $user = $request->user();

        $tx = Transaction::create([
            'user_id' => $user->id,
            'type' => 'topup',
            'amount' => $request->amount,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        return redirect()->route('wallet.index')->with('success', 'Top-up request dibuat. Tunggu persetujuan admin.');
    }
}
