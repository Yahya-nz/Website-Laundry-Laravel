<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * This will populate the database with sample data for development and testing.
     *
     * To run all seeders:
     *   php artisan db:seed
     *
     * To run specific seeder:
     *   php artisan db:seed --class=UserSeeder
     *
     * To refresh database and seed:
     *   php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');
        $this->command->newLine();

        // Step 1: Seed users and wallets
        $this->command->info('📝 Seeding users and wallets...');
        $this->call([
            UserSeeder::class,
        ]);
        $this->command->newLine();

        // Step 2: Seed status pesanan (if exists)
        if (class_exists(\Database\Seeders\StatusPesananSeeder::class)) {
            $this->command->info('📋 Seeding status pesanan...');
            $this->call([
                StatusPesananSeeder::class,
            ]);
            $this->command->newLine();
        }

        // Step 3: Seed orders
        $this->command->info('📦 Seeding orders...');
        $this->call([
            OrderSeeder::class,
        ]);
        $this->command->newLine();

        // Step 4: Seed invoices
        $this->command->info('🧾 Seeding invoices...');
        $this->call([
            InvoiceSeeder::class,
        ]);
        $this->command->newLine();

        // Step 5: Seed transactions
        $this->command->info('💰 Seeding transactions...');
        $this->call([
            TransactionSeeder::class,
        ]);
        $this->command->newLine();

        // Summary
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->newLine();
        $this->command->info('📊 Summary:');
        $this->command->info('   - 11 Users (1 Admin, 2 Staff, 8 Customers)');
        $this->command->info('   - 10 Sample Orders (various statuses)');
        $this->command->info('   - 4 Invoices (paid & pending)');
        $this->command->info('   - 10 Transactions (topup, payment, transfer)');
        $this->command->newLine();
        $this->command->info('🔑 Login Credentials:');
        $this->command->info('   Admin:  admin@laundryku.com / password');
        $this->command->info('   Staff:  staff1@laundryku.com / password');
        $this->command->info('   User:   ahmad.rizki@gmail.com / password');
        $this->command->newLine();
    }
}