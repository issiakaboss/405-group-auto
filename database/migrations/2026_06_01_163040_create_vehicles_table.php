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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->integer('mileage');
            $table->string('fuel_type');
            $table->string('transmission');
            $table->string('category');
            $table->decimal('price', 12, 2);
           $table->json('images');

            // Notre touche spéciale Import/Export USA - Afrique
            $table->enum('status', ['available_usa', 'in_transit', 'available_local'])->default('available_usa');
            $table->string('location'); 

            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
