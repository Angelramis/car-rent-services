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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 150);
            $table->string('model', 150);
            $table->string('plate', 7);
            $table->foreignId('category_id')->references('category_id')->on('categories');
            $table->decimal('price_per_day', 8, 2);
            $table->string('image');
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('fuel_type', ['gasoline', 'diesel', 'electric', 'hybrid']);
            $table->integer('doors_number');
            $table->integer('min_age');
            $table->boolean("free_cancelation");
            $table->integer("bag_space");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
