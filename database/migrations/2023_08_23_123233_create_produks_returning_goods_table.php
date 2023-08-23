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
        Schema::create('produks_returning_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('returning_good_id')->constrained('returning_goods');
            $table->foreignId('produk_id')->constrained('produks');
            $table->bigInteger('quantity');
            $table->bigInteger('price');
            $table->bigInteger('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks_returning_goods');
    }
};
