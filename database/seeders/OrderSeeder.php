<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Get staff users
        $staff = User::where('role', 'staff')->orWhere('role', 'admin')->get();

        if ($staff->isEmpty()) {
            $this->command->warn('No staff users found. Please run UserSeeder first.');
            return;
        }

        // Valid process_status values based on migration:
        // 'penerimaan', 'pencucian', 'pengeringan', 'setrika', 'selesai'

        $orders = [
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0001',
                'nama_pelanggan' => 'Ahmad Rizki',
                'whatsapp' => '081111111111',
                'layanan' => 'Cuci Setrika',
                'berat' => 5.5,
                'jumlah_pakaian' => 15,
                'total_harga' => 55000,
                'status' => 'completed',
                'process_status' => 'selesai',
                'catatan' => 'Tolong pisahkan baju putih',
                'pickup_estimation' => Carbon::yesterday(),
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0002',
                'nama_pelanggan' => 'Dewi Lestari',
                'whatsapp' => '081222222222',
                'layanan' => 'Express',
                'berat' => 3.0,
                'jumlah_pakaian' => 8,
                'total_harga' => 60000,
                'status' => 'ready',
                'process_status' => 'selesai',
                'catatan' => 'Butuh cepat, ada acara malam ini',
                'pickup_estimation' => Carbon::today(),
                'notified_done' => true,
                'created_at' => Carbon::now()->subDays(4),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0003',
                'nama_pelanggan' => 'Eko Prasetyo',
                'whatsapp' => '081333333333',
                'layanan' => 'Cuci Kering',
                'berat' => 7.0,
                'jumlah_pakaian' => 20,
                'total_harga' => 56000,
                'status' => 'processing',
                'process_status' => 'pengeringan',
                'catatan' => null,
                'pickup_estimation' => Carbon::tomorrow(),
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0004',
                'nama_pelanggan' => 'Fitri Handayani',
                'whatsapp' => '081444444444',
                'layanan' => 'Dry Clean',
                'berat' => 2.0,
                'jumlah_pakaian' => 3,
                'total_harga' => 150000,
                'status' => 'processing',
                'process_status' => 'pencucian',
                'catatan' => 'Jas dan gaun pesta',
                'pickup_estimation' => Carbon::now()->addDays(2),
                'created_at' => Carbon::now()->subDay(),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0005',
                'nama_pelanggan' => 'Gunawan Wijaya',
                'whatsapp' => '081555555555',
                'layanan' => 'Setrika Saja',
                'berat' => 4.0,
                'jumlah_pakaian' => 12,
                'total_harga' => 24000,
                'status' => 'pending',
                'process_status' => 'penerimaan',
                'catatan' => 'Kemeja kantor semua',
                'pickup_estimation' => Carbon::now()->addDays(1),
                'created_at' => Carbon::now(),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0006',
                'nama_pelanggan' => 'Hana Safira',
                'whatsapp' => '081666666666',
                'layanan' => 'Cuci Setrika',
                'berat' => 6.5,
                'jumlah_pakaian' => 18,
                'total_harga' => 65000,
                'status' => 'processing',
                'process_status' => 'setrika',
                'catatan' => 'Jangan gunakan pewangi',
                'pickup_estimation' => Carbon::tomorrow(),
                'created_at' => Carbon::now()->subDay(),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0007',
                'nama_pelanggan' => 'Irfan Maulana',
                'whatsapp' => '081777777777',
                'layanan' => 'Cuci Kering',
                'berat' => 8.0,
                'jumlah_pakaian' => 25,
                'total_harga' => 64000,
                'status' => 'completed',
                'process_status' => 'selesai',
                'catatan' => null,
                'pickup_estimation' => Carbon::yesterday(),
                'notified_done' => true,
                'notified_pickup' => true,
                'created_at' => Carbon::now()->subDays(6),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0008',
                'nama_pelanggan' => 'Jasmine Putri',
                'whatsapp' => '081888888888',
                'layanan' => 'Express',
                'berat' => 4.5,
                'jumlah_pakaian' => 10,
                'total_harga' => 90000,
                'status' => 'ready',
                'process_status' => 'selesai',
                'catatan' => 'Urgent! Besok pagi sudah harus diambil',
                'pickup_estimation' => Carbon::today(),
                'notified_done' => true,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0009',
                'nama_pelanggan' => 'Bapak Sukarno',
                'whatsapp' => '081999999999',
                'layanan' => 'Cuci Setrika',
                'berat' => 10.0,
                'jumlah_pakaian' => 30,
                'total_harga' => 100000,
                'status' => 'processing',
                'process_status' => 'pencucian',
                'catatan' => 'Cucian keluarga, tolong rapi',
                'pickup_estimation' => Carbon::now()->addDays(2),
                'created_at' => Carbon::now(),
            ],
            [
                'invoice_number' => 'INV-' . date('Ymd') . '-0010',
                'nama_pelanggan' => 'Ibu Kartini',
                'whatsapp' => '081000000000',
                'layanan' => 'Setrika Saja',
                'berat' => 3.5,
                'jumlah_pakaian' => 10,
                'total_harga' => 21000,
                'status' => 'pending',
                'process_status' => 'penerimaan',
                'catatan' => null,
                'pickup_estimation' => Carbon::now()->addDay(),
                'created_at' => Carbon::now(),
            ],
        ];

        foreach ($orders as $orderData) {
            // Assign random staff to each order
            $randomStaff = $staff->random();
            $orderData['staff_id'] = $randomStaff->id;

            Order::firstOrCreate(
                ['invoice_number' => $orderData['invoice_number']],
                $orderData
            );
        }

        $this->command->info('✓ Created 10 sample orders with various statuses');
    }
}