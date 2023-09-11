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
        Schema::create('suppliers_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suppliers_id')->constrained('suppliers')->cascadeOnDelete();
            $table->foreignId('raw_materials_id')->constrained('raw_materials')->cascadeOnDelete();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers_raw_materials');
    }
};
