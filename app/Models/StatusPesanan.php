<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPesanan extends Model
{
    use HasFactory;

    protected $table = 'status_pesanans'; // cocokkan dengan nama tabel migrasi
    protected $fillable = ['nama_status'];
}
