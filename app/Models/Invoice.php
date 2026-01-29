<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'order_id',
        'customer_id',
        'customer_name',
        'customer_whatsapp',
        'subtotal',
        'discount',
        'tax',
        'total',
        'status',
        'paid_at',
        'notes',
        'whatsapp_sent',
        'whatsapp_sent_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'whatsapp_sent_at' => 'datetime',
        'whatsapp_sent' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = 'INV-' . date('Ymd') . '-' . str_pad(static::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
