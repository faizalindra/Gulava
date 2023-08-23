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
        Schema::create('returing_goods', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('petty_cash_id')->constrained('petty_cash');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('salesperson_id')->constrained('salespersons');
            $table->foreignId('outgoing_good_id')->constrained('outgoing_goods');
            $table->bigInteger('total_amount');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returing_goods');
    }
};
