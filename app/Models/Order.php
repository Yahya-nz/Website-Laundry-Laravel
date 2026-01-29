<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'staff_id',
        'nama_pelanggan',
        'whatsapp',
        'layanan',
        'berat',
        'jumlah_pakaian',
        'total_harga',
        'status',
        'catatan',
        'process_status',
        'notified_done',
        'notified_pickup',
        'pickup_estimation'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
