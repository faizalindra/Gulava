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
        Schema::create('outgoing_goods_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outgoing_good_id')->constrained('outgoing_goods');
            $table->foreignId('produk_id')->constrained('produks');
            $table->bigInteger('quantity');
            $table->bigInteger('price');
            $table->bigInteger('total_price');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_goods_produks');
    }
};
