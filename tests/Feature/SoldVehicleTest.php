<?php

namespace Tests\Feature;

use App\Models\Enums\VehicleStatus;
use App\Models\SoldVehicle;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoldVehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_only_receives_visible_sold_vehicles_with_the_vehicle_relation_loaded(): void
    {
        $visibleVehicle = $this->createVehicle('Visible Coupe');
        $hiddenVehicle = $this->createVehicle('Hidden Sedan');

        $visibleSale = SoldVehicle::create([
            'vehicle_id' => $visibleVehicle->id,
            'sold_date' => '2026-09-20',
            'is_visible' => true,
        ]);

        SoldVehicle::create([
            'vehicle_id' => $hiddenVehicle->id,
            'sold_date' => '2026-09-25',
            'is_visible' => false,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee(__('public/home.sold_delivered'))
            ->assertViewHas('recentlySoldVehicles', function ($soldVehicles) use ($visibleSale): bool {
                return $soldVehicles->count() === 1
                    && $soldVehicles->first()->is($visibleSale)
                    && $soldVehicles->first()->relationLoaded('vehicle');
            });
    }

    public function test_unavailable_vehicle_card_does_not_render_the_reserve_form(): void
    {
        $vehicle = $this->createVehicle('Unavailable Sedan');
        $vehicle->update(['status' => VehicleStatus::UNAVAILABLE]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSeeText($vehicle->status->label())
            ->assertDontSee('<form action="' . route('cart.add', $vehicle) . '" method="POST"', false);
    }

    public function test_sold_vehicle_detail_shows_delivery_date_and_hides_purchase_actions(): void
    {
        $vehicle = $this->createVehicle('Delivered Coupe');
        $soldRecord = SoldVehicle::create([
            'vehicle_id' => $vehicle->id,
            'sold_date' => '2026-09-14',
            'is_visible' => true,
        ]);

        $this->get(route('vehicles.show', ['vehicle' => $vehicle, 'from' => 'sold']))
            ->assertOk()
            ->assertSee(__('public/home.sold_delivered'))
            ->assertSee($soldRecord->sold_date->translatedFormat('d F Y'))
            ->assertDontSee('action="' . route('cart.add', $vehicle) . '"', false)
            ->assertDontSee('action="' . route('favorites.toggle', $vehicle) . '"', false)
            ->assertDontSee('action="' . route('testdrive.store') . '"', false);
    }

    public function test_sold_history_does_not_change_the_standard_detail_without_sold_context(): void
    {
        $vehicle = $this->createVehicle('Previously Sold Coupe');
        SoldVehicle::create([
            'vehicle_id' => $vehicle->id,
            'sold_date' => '2026-09-14',
            'is_visible' => true,
        ]);

        $this->get(route('vehicles.show', $vehicle))
            ->assertOk()
            ->assertDontSee(__('public/home.sold_delivered'))
            ->assertSee('action="' . route('cart.add', $vehicle) . '"', false);
    }

    public function test_unavailable_vehicle_detail_hides_purchase_and_visit_actions(): void
    {
        $vehicle = $this->createVehicle('Unavailable Coupe');
        $vehicle->update(['status' => VehicleStatus::UNAVAILABLE]);

        $this->get(route('vehicles.show', $vehicle))
            ->assertOk()
            ->assertSeeText($vehicle->status->label())
            ->assertDontSee('action="' . route('cart.add', $vehicle) . '"', false)
            ->assertDontSee('action="' . route('testdrive.store') . '"', false);
    }

    private function createVehicle(string $title): Vehicle
    {
        return Vehicle::create([
            'title' => $title,
            'make' => 'Test Make',
            'model' => $title,
            'year' => 2024,
            'mileage' => 1000,
            'vehicle_type' => 'cars_and_trucks',
            'body_style' => 'coupe',
            'exterior_color' => 'black',
            'interior_color' => 'black',
            'fuel_type' => 'gasoline',
            'transmission' => 'automatic',
            'has_clean_title' => true,
            'location' => 'usa_oklahoma',
            'price' => 25000,
            'images' => [],
            'status' => 'available',
            'is_featured' => false,
        ]);
    }
}
