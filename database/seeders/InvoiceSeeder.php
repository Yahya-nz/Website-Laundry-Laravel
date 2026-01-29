<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Order;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        // Get orders that should have invoices (completed or ready status)
        $orders = Order::whereIn('status', ['completed', 'ready'])->get();

        if ($orders->isEmpty()) {
            $this->command->warn('No completed/ready orders found. Please run OrderSeeder first.');
            return;
        }

        $invoiceData = [
            // Invoice untuk order pertama (Ahmad Rizki - Completed)
            [
                'order' => $orders->where('nama_pelanggan', 'Ahmad Rizki')->first(),
                'discount' => 5000,
                'tax' => 0,
                'status' => 'paid',
                'paid_at' => Carbon::now()->subDays(4),
                'notes' => 'Pelanggan setia - diskon 5rb',
                'whatsapp_sent' => true,
                'whatsapp_sent_at' => Carbon::now()->subDays(4),
            ],
            // Invoice untuk order kedua (Dewi Lestari - Ready)
            [
                'order' => $orders->where('nama_pelanggan', 'Dewi Lestari')->first(),
                'discount' => 0,
                'tax' => 0,
                'status' => 'pending',
                'paid_at' => null,
                'notes' => 'Express service',
                'whatsapp_sent' => true,
                'whatsapp_sent_at' => Carbon::now()->subHours(2),
            ],
            // Invoice untuk order ketujuh (Irfan Maulana - Completed)
            [
                'order' => $orders->where('nama_pelanggan', 'Irfan Maulana')->first(),
                'discount' => 0,
                'tax' => 0,
                'status' => 'paid',
                'paid_at' => Carbon::now()->subDays(5),
                'notes' => null,
                'whatsapp_sent' => true,
                'whatsapp_sent_at' => Carbon::now()->subDays(5),
            ],
            // Invoice untuk order kedelapan (Jasmine Putri - Ready)
            [
                'order' => $orders->where('nama_pelanggan', 'Jasmine Putri')->first(),
                'discount' => 10000,
                'tax' => 0,
                'status' => 'pending',
                'paid_at' => null,
                'notes' => 'Promo express - diskon 10rb',
                'whatsapp_sent' => true,
                'whatsapp_sent_at' => Carbon::now()->subHours(5),
            ],
        ];

        $createdCount = 0;

        foreach ($invoiceData as $data) {
            if (!$data['order']) {
                continue;
            }

            $order = $data['order'];

            // Calculate invoice amounts
            $subtotal = $order->total_harga;
            $discount = $data['discount'];
            $tax = $data['tax'];
            $total = $subtotal - $discount + $tax;

            $invoice = Invoice::firstOrCreate(
                ['order_id' => $order->id],
                [
                    'invoice_number' => $order->invoice_number,
                    'customer_id' => null, // Could be linked to customer model if needed
                    'customer_name' => $order->nama_pelanggan,
                    'customer_whatsapp' => $order->whatsapp,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => $tax,
                    'total' => $total,
                    'status' => $data['status'],
                    'paid_at' => $data['paid_at'],
                    'notes' => $data['notes'],
                    'whatsapp_sent' => $data['whatsapp_sent'],
                    'whatsapp_sent_at' => $data['whatsapp_sent_at'],
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                ]
            );

            if ($invoice->wasRecentlyCreated) {
                $createdCount++;
            }
        }

        $this->command->info("✓ Created {$createdCount} sample invoices (paid and pending)");
    }
}