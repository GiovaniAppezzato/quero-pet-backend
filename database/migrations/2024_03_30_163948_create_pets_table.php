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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('breed');
            $table->string('age');
            $table->string('weight');
            $table->string('color');
            $table->string('banner');
            $table->enum('sex', ['M', 'F']);
            $table->date("birth_date")->nullable();
            $table->boolean('is_vaccinated');
            $table->foreignId('ong_id')->constrained('ongs');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
