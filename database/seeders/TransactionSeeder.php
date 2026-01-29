<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Get customer users
        $customers = User::where('role', 'user')->get();

        if ($customers->isEmpty()) {
            $this->command->warn('No customer users found. Please run UserSeeder first.');
            return;
        }

        // Get specific customers for transactions
        $ahmad = $customers->where('email', 'ahmad.rizki@gmail.com')->first();
        $dewi = $customers->where('email', 'dewi.lestari@gmail.com')->first();
        $fitri = $customers->where('email', 'fitri.handayani@gmail.com')->first();
        $hana = $customers->where('email', 'hana.safira@gmail.com')->first();
        $jasmine = $customers->where('email', 'jasmine.putri@gmail.com')->first();

        $transactions = [
            // Top-up transactions (pending approval)
            [
                'user_id' => $ahmad ? $ahmad->id : $customers->first()->id,
                'type' => 'topup',
                'amount' => 100000,
                'currency' => 'IDR',
                'status' => 'pending',
                'notes' => 'Top up via transfer BCA',
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'user_id' => $fitri ? $fitri->id : $customers->skip(1)->first()->id,
                'type' => 'topup',
                'amount' => 200000,
                'currency' => 'IDR',
                'status' => 'pending',
                'notes' => 'Top up via transfer Mandiri',
                'created_at' => Carbon::now()->subHours(5),
            ],

            // Approved top-up transactions
            [
                'user_id' => $dewi ? $dewi->id : $customers->skip(2)->first()->id,
                'type' => 'topup',
                'amount' => 150000,
                'currency' => 'IDR',
                'status' => 'approved',
                'notes' => 'Top up via transfer BRI - Approved',
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => $hana ? $hana->id : $customers->skip(3)->first()->id,
                'type' => 'topup',
                'amount' => 100000,
                'currency' => 'IDR',
                'status' => 'approved',
                'notes' => 'Top up via transfer BCA - Approved',
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'user_id' => $jasmine ? $jasmine->id : $customers->skip(4)->first()->id,
                'type' => 'topup',
                'amount' => 250000,
                'currency' => 'IDR',
                'status' => 'approved',
                'notes' => 'Top up via e-wallet',
                'created_at' => Carbon::now()->subDays(1),
            ],

            // Rejected top-up transaction
            [
                'user_id' => $ahmad ? $ahmad->id : $customers->first()->id,
                'type' => 'topup',
                'amount' => 50000,
                'currency' => 'IDR',
                'status' => 'rejected',
                'notes' => 'Bukti transfer tidak jelas',
                'created_at' => Carbon::now()->subDays(4),
            ],

            // Payment transactions (for laundry services)
            [
                'user_id' => $ahmad ? $ahmad->id : $customers->first()->id,
                'type' => 'payment',
                'amount' => 50000,
                'currency' => 'IDR',
                'status' => 'approved',
                'notes' => 'Pembayaran laundry - INV-' . date('Ymd') . '-0001',
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => $hana ? $hana->id : $customers->skip(3)->first()->id,
                'type' => 'payment',
                'amount' => 20000,
                'currency' => 'IDR',
                'status' => 'approved',
                'notes' => 'Pembayaran setrika - INV-' . date('Ymd') . '-0006',
                'created_at' => Carbon::now()->subDay(),
            ],

            // Transfer between users
            [
                'user_id' => $fitri ? $fitri->id : $customers->skip(1)->first()->id,
                'type' => 'transfer',
                'amount' => 25000,
                'currency' => 'IDR',
                'status' => 'approved',
                'notes' => 'Transfer ke teman',
                'target_user_id' => $jasmine ? $jasmine->id : $customers->last()->id,
                'created_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($transactions as $transactionData) {
            Transaction::create($transactionData);
        }

        $this->command->info('✓ Created 10 sample transactions (topup, payment, transfer)');
        $this->command->info('  - 2 pending topup transactions (need approval)');
        $this->command->info('  - 3 approved topup transactions');
        $this->command->info('  - 1 rejected topup transaction');
        $this->command->info('  - 2 payment transactions');
        $this->command->info('  - 1 transfer transaction');
    }
}