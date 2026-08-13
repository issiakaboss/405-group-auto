<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('make');
            $table->string('model');
            $table->integer('year_min')->nullable();
            $table->integer('year_max')->nullable();
            $table->integer('max_budget')->nullable();
            $table->integer('desired_mileage')->nullable();
            $table->string('body_style')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('zip_code');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_requests');
    }
};
