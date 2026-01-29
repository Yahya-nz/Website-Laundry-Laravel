<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Account
        $admin = User::firstOrCreate(
            ['email' => 'admin@laundryku.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'whatsapp' => '081234567890'
            ]
        );
        Wallet::firstOrCreate(['user_id' => $admin->id], ['balance' => 0]);

        // Staff Accounts
        $staff1 = User::firstOrCreate(
            ['email' => 'staff1@laundryku.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'whatsapp' => '081234567891'
            ]
        );
        Wallet::firstOrCreate(['user_id' => $staff1->id], ['balance' => 0]);

        $staff2 = User::firstOrCreate(
            ['email' => 'staff2@laundryku.com'],
            [
                'name' => 'Siti Rahma',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'whatsapp' => '081234567892'
            ]
        );
        Wallet::firstOrCreate(['user_id' => $staff2->id], ['balance' => 0]);

        // Customer Accounts
        $customers = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@gmail.com',
                'whatsapp' => '081111111111',
                'balance' => 150000
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'whatsapp' => '081222222222',
                'balance' => 200000
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@gmail.com',
                'whatsapp' => '081333333333',
                'balance' => 75000
            ],
            [
                'name' => 'Fitri Handayani',
                'email' => 'fitri.handayani@gmail.com',
                'whatsapp' => '081444444444',
                'balance' => 300000
            ],
            [
                'name' => 'Gunawan Wijaya',
                'email' => 'gunawan.wijaya@gmail.com',
                'whatsapp' => '081555555555',
                'balance' => 50000
            ],
            [
                'name' => 'Hana Safira',
                'email' => 'hana.safira@gmail.com',
                'whatsapp' => '081666666666',
                'balance' => 120000
            ],
            [
                'name' => 'Irfan Maulana',
                'email' => 'irfan.maulana@gmail.com',
                'whatsapp' => '081777777777',
                'balance' => 0
            ],
            [
                'name' => 'Jasmine Putri',
                'email' => 'jasmine.putri@gmail.com',
                'whatsapp' => '081888888888',
                'balance' => 250000
            ]
        ];

        foreach ($customers as $customerData) {
            $user = User::firstOrCreate(
                ['email' => $customerData['email']],
                [
                    'name' => $customerData['name'],
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'whatsapp' => $customerData['whatsapp']
                ]
            );
            Wallet::firstOrCreate(
                ['user_id' => $user->id],
                ['balance' => $customerData['balance']]
            );
        }

        $this->command->info('✓ Created 1 Admin, 2 Staff, and 8 Customer accounts');
        $this->command->info('✓ All passwords are: password');
    }
}