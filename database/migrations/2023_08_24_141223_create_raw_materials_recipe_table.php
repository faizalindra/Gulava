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
        Schema::create('raw_materials_recipe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raw_material_id')->constrained('raw_materials')->cascadeOnDelete();
            $table->foreignId('recipe_id')->constrained('recipes')->cascadeOnDelete();
            $table->integer('quantity');
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials_recipe');
    }
};
