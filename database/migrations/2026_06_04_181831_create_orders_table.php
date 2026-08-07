<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('total_estimated_price', 12, 2); // Prix total indicatif des véhicules réservés
            $table->string('status')->default('pending_review'); // pending_review, contacted, scheduled, cancelled
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->text('notes')->nullable(); // Ex: préférence d'horaire pour le test drive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};