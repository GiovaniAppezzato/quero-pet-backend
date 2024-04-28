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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'adopted', 'canceled']);
            $table->dateTime('canceled_at')->nullable();
            $table->dateTime('adopted_at')->nullable();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->foreignId('adopter_id')->constrained()->onDelete('cascade');
            $table->foreignId('ong_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
