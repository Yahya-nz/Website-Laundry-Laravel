<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('process_status', [
                'penerimaan',
                'pencucian',
                'pengeringan',
                'setrika',
                'selesai'
            ])->default('penerimaan');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('process_status');
        });
    }
};
