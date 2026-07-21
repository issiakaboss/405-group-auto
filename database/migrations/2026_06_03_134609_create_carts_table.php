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
      Schema::create('carts', function (Blueprint $bluePrint) {
            $bluePrint->id();
            $bluePrint->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $bluePrint->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $bluePrint->integer('quantity')->default(1); 
            $bluePrint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
