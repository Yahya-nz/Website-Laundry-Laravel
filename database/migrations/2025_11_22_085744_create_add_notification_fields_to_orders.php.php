<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('notified_done')->default(false);
            $table->boolean('notified_pickup')->default(false);
            $table->dateTime('pickup_estimation')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('notified_done');
            $table->dropColumn('notified_pickup');
            $table->dropColumn('pickup_estimation');
        });
    }
};
