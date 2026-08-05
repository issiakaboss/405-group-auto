<?php

use App\Models\Enums\VehicleLocation;
use App\Models\Enums\VehicleStatus;
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
            $table->string('make');
            $table->string('model');
            $table->string('trim')->nullable();
            $table->integer('year');
            $table->integer('mileage');
            $table->string('vehicle_type');
            $table->string('body_style');
            $table->string('exterior_color');
            $table->string('interior_color');
            $table->string('fuel_type');
            $table->string('transmission');
            $table->boolean('has_clean_title')->default(false);
            $table->string('money_still_owed')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->json('images');
            $table->string('status')->default(VehicleStatus::AVAILABLE->value);
            $table->string('location')->default(VehicleLocation::USA_OKLAHOMA->value);
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
