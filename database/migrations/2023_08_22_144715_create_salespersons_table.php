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
        Schema::create('salespersons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('villege');
            $table->string('district');
            $table->string('city');
            $table->string('phone', 20);
            $table->string('email')->unique()->nullable();
            $table->enum('gender',['M','F']);
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('npwp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salesperson');
    }
};
