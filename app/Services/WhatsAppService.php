<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $apiUrl;
    protected $apiKey;
    protected $fromNumber;

    public function __construct()
    {
        $this->apiUrl = env('WHATSAPP_API_URL', 'https://api.whatsapp.com/send');
        $this->apiKey = env('WHATSAPP_API_KEY', '');
        $this->fromNumber = env('WHATSAPP_FROM_NUMBER', '');
    }

    public function sendInvoice(Invoice $invoice)
    {
        if (!$invoice->customer_whatsapp) {
            throw new \Exception('Nomor WhatsApp customer tidak tersedia');
        }

        $message = $this->formatInvoiceMessage($invoice);
        return $this->sendMessage($invoice->customer_whatsapp, $message);
    }

    public function sendOrderNotification(Order $order, $status = 'completed')
    {
        if (!$order->whatsapp) {
            throw new \Exception('Nomor WhatsApp tidak tersedia');
        }

        $message = $this->formatOrderMessage($order, $status);
        return $this->sendMessage($order->whatsapp, $message);
    }

    protected function formatInvoiceMessage(Invoice $invoice)
    {
        $message = "*INVOICE LAUNDRY*\n\n";
        $message .= "Invoice: {$invoice->invoice_number}\n";
        $message .= "Tanggal: " . $invoice->created_at->format('d M Y') . "\n\n";

        $message .= "*Detail Pelanggan:*\n";
        $message .= "Nama: {$invoice->customer_name}\n\n";

        if ($invoice->order) {
            $message .= "*Detail Pesanan:*\n";
            $message .= "Layanan: {$invoice->order->layanan}\n";

            if ($invoice->order->berat) {
                $message .= "Berat: {$invoice->order->berat} kg\n";
            }

            if ($invoice->order->jumlah_pakaian) {
                $message .= "Jumlah Pakaian: {$invoice->order->jumlah_pakaian} pcs\n";
            }

            $message .= "\n";
        }

        $message .= "*Rincian Biaya:*\n";
        $message .= "Subtotal: Rp " . number_format($invoice->subtotal, 0, ',', '.') . "\n";

        if ($invoice->discount > 0) {
            $message .= "Diskon: Rp " . number_format($invoice->discount, 0, ',', '.') . "\n";
        }

        if ($invoice->tax > 0) {
            $message .= "Pajak: Rp " . number_format($invoice->tax, 0, ',', '.') . "\n";
        }

        $message .= "*Total: Rp " . number_format($invoice->total, 0, ',', '.') . "*\n\n";

        $message .= "Status: " . strtoupper($invoice->status) . "\n";

        if ($invoice->notes) {
            $message .= "\nCatatan: {$invoice->notes}\n";
        }

        $message .= "\nTerima kasih telah menggunakan layanan kami! 🙏";

        return $message;
    }

    protected function formatOrderMessage(Order $order, $status)
    {
        $message = "*UPDATE PESANAN LAUNDRY*\n\n";
        $message .= "Halo {$order->nama_pelanggan},\n\n";

        if ($status === 'completed') {
            $message .= "Pesanan laundry Anda telah *SELESAI* dan siap diambil! ✅\n\n";
        } elseif ($status === 'processing') {
            $message .= "Pesanan laundry Anda sedang *DALAM PROSES* 🧺\n\n";
        } elseif ($status === 'ready_pickup') {
            $message .= "Pesanan laundry Anda *SIAP DIAMBIL* 📦\n\n";
        }

        $message .= "*Detail Pesanan:*\n";
        $message .= "Layanan: {$order->layanan}\n";

        if ($order->berat) {
            $message .= "Berat: {$order->berat} kg\n";
        }

        if ($order->jumlah_pakaian) {
            $message .= "Jumlah Pakaian: {$order->jumlah_pakaian} pcs\n";
        }

        $message .= "Total Harga: Rp " . number_format($order->total_harga, 0, ',', '.') . "\n";

        if ($order->catatan) {
            $message .= "\nCatatan: {$order->catatan}\n";
        }

        $message .= "\nTerima kasih! 🙏";

        return $message;
    }

    protected function sendMessage($phoneNumber, $message)
    {
        $phoneNumber = $this->formatPhoneNumber($phoneNumber);

        try {
            if (env('WHATSAPP_PROVIDER') === 'fonnte') {
                return $this->sendViaFonnte($phoneNumber, $message);
            } elseif (env('WHATSAPP_PROVIDER') === 'wablas') {
                return $this->sendViaWablas($phoneNumber, $message);
            } else {
                return $this->sendViaWeb($phoneNumber, $message);
            }
        } catch (\Exception $e) {
            Log::error('WhatsApp sending failed: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function sendViaFonnte($phoneNumber, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
        ])->post('https://api.fonnte.com/send', [
            'target' => $phoneNumber,
            'message' => $message,
        ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => 'Pesan berhasil dikirim via Fonnte',
                'response' => $response->json()
            ];
        }

        throw new \Exception('Gagal mengirim pesan via Fonnte: ' . $response->body());
    }

    protected function sendViaWablas($phoneNumber, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
        ])->post('https://console.wablas.com/api/send-message', [
            'phone' => $phoneNumber,
            'message' => $message,
        ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => 'Pesan berhasil dikirim via Wablas',
                'response' => $response->json()
            ];
        }

        throw new \Exception('Gagal mengirim pesan via Wablas: ' . $response->body());
    }

    protected function sendViaWeb($phoneNumber, $message)
    {
        $url = "https://wa.me/{$phoneNumber}?text=" . urlencode($message);

        return [
            'success' => true,
            'message' => 'URL WhatsApp berhasil dibuat',
            'url' => $url,
            'note' => 'Buka URL untuk mengirim pesan'
        ];
    }

    protected function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        } elseif (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }

        return $phoneNumber;
    }
}
