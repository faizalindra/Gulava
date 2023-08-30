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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('petty_cash_id')->constrained('petty_cash')->cascadeOnDelete();
            $table->bigInteger('total_price');
            $table->bigInteger('paid_price');
            $table->bigInteger('change_price');
            $table->bigInteger('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
