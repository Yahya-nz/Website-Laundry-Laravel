<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable()->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // initiator / owner
            $table->enum('type', ['topup', 'payment', 'transfer'])->index();
            $table->decimal('amount', 15, 2);
            $table->string('currency', 10)->default('IDR');
            $table->string('status')->default('pending'); // pending, approved, rejected, completed, failed
            $table->text('notes')->nullable();
            // for transfers / payments:
            $table->foreignId('target_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
