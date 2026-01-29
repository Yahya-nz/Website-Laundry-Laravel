<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('jumlah_pakaian')->nullable()->after('berat');
            $table->string('whatsapp')->nullable()->after('nama_pelanggan');
            $table->text('catatan')->nullable()->after('status');
            $table->foreignId('staff_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            $table->string('invoice_number')->nullable()->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['jumlah_pakaian', 'whatsapp', 'catatan', 'staff_id', 'invoice_number']);
        });
    }
};
