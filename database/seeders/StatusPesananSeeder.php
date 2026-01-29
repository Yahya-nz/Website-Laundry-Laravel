<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusPesanan;

class StatusPesananSeeder extends Seeder
{
    public function run(): void
    {
        $status = ['Baru', 'Proses', 'Selesai', 'Diantar', 'Dibatalkan'];
        foreach ($status as $s) {
            StatusPesanan::create(['nama_status' => $s]);
        }
    }
}