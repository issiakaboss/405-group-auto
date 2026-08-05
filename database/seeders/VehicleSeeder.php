<?php

namespace Database\Seeders;

use App\Models\Enums\BodyStyle;
use App\Models\Enums\FuelType;
use App\Models\Enums\Transmission;
use App\Models\Enums\VehicleColor;
use App\Models\Enums\VehicleLocation;
use App\Models\Enums\VehicleStatus;
use App\Models\Enums\VehicleType;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::create([
            'title' => 'BMW M4 Competition',
            'make' => 'BMW',
            'model' => 'M4',
            'trim' => 'Competition',
            'year' => 2024,
            'mileage' => 0,
            'vehicle_type' => VehicleType::CARS_AND_TRUCKS->value,
            'body_style' => BodyStyle::COUPE->value,
            'exterior_color' => VehicleColor::BLACK->value,
            'interior_color' => VehicleColor::BLACK->value,
            'fuel_type' => FuelType::GASOLINE->value,
            'transmission' => Transmission::AUTOMATIC->value,
            'has_clean_title' => true,
            'money_still_owed' => null,
            'location' => VehicleLocation::USA_OKLAHOMA->value,
            'price' => 89950,
            'description' => 'Performance coupe with premium interior and full U.S. dealership history.',
            'images' => [
                'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1607853202273-797f1c22a38e?auto=format&fit=crop&w=800&q=80',
            ],
            'status' => VehicleStatus::AVAILABLE->value,
            'is_featured' => true,
        ]);

        Vehicle::create([
            'title' => 'Mercedes-Benz S-Class',
            'make' => 'Mercedes-Benz',
            'model' => 'S-Class',
            'trim' => 'AMG Line',
            'year' => 2024,
            'mileage' => 1200,
            'vehicle_type' => VehicleType::LUXURY->value,
            'body_style' => BodyStyle::SEDAN->value,
            'exterior_color' => VehicleColor::WHITE->value,
            'interior_color' => VehicleColor::BROWN->value,
            'fuel_type' => FuelType::GASOLINE->value,
            'transmission' => Transmission::AUTOMATIC->value,
            'has_clean_title' => true,
            'money_still_owed' => null,
            'location' => VehicleLocation::USA_OKLAHOMA->value,
            'price' => 112350,
            'description' => 'Luxury flagship sedan with a refined cabin and smooth all-wheel drive.',
            'images' => [
                'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1616422285623-13ff0162193c?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80',
            ],
            'status' => VehicleStatus::AVAILABLE->value,
            'is_featured' => true,
        ]);

        Vehicle::create([
            'title' => 'Tesla Model S Plaid',
            'make' => 'Tesla',
            'model' => 'Model S',
            'trim' => 'Plaid',
            'year' => 2024,
            'mileage' => 0,
            'vehicle_type' => VehicleType::LUXURY->value,
            'body_style' => BodyStyle::SEDAN->value,
            'exterior_color' => VehicleColor::SILVER->value,
            'interior_color' => VehicleColor::BLACK->value,
            'fuel_type' => FuelType::ELECTRIC->value,
            'transmission' => Transmission::AUTOMATIC->value,
            'has_clean_title' => true,
            'money_still_owed' => null,
            'location' => VehicleLocation::USA_OKLAHOMA->value,
            'price' => 94990,
            'description' => 'High-performance electric sedan for buyers seeking range and innovation.',
            'images' => [
                'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?auto=format&fit=crop&w=800&q=80',
            ],
            'status' => VehicleStatus::IN_TRANSIT->value,
            'is_featured' => true,
        ]);

        Vehicle::create([
            'title' => 'Porsche 911 GT3 RS',
            'make' => 'Porsche',
            'model' => '911',
            'trim' => 'GT3 RS',
            'year' => 2025,
            'mileage' => 150,
            'vehicle_type' => VehicleType::CARS_AND_TRUCKS->value,
            'body_style' => BodyStyle::COUPE->value,
            'exterior_color' => VehicleColor::RED->value,
            'interior_color' => VehicleColor::BLACK->value,
            'fuel_type' => FuelType::GASOLINE->value,
            'transmission' => Transmission::DUAL_CLUTCH->value,
            'has_clean_title' => true,
            'money_still_owed' => null,
            'location' => VehicleLocation::USA_OKLAHOMA->value,
            'price' => 223000,
            'description' => 'Track-ready luxury coupe with limited production appeal and showroom presentation.',
            'images' => [
                'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80',
            ],
            'status' => VehicleStatus::AVAILABLE    ->value,
            'is_featured' => false,
        ]);

        Vehicle::create([
            'title' => 'Range Rover Autobiography',
            'make' => 'Land Rover',
            'model' => 'Range Rover',
            'trim' => 'Autobiography',
            'year' => 2025,
            'mileage' => 0,
            'vehicle_type' => VehicleType::SUVs->value,
            'body_style' => BodyStyle::SUV->value,
            'exterior_color' => VehicleColor::BLUE->value,
            'interior_color' => VehicleColor::BROWN->value,
            'fuel_type' => FuelType::HYBRID->value,
            'transmission' => Transmission::AUTOMATIC->value,
            'has_clean_title' => true,
            'money_still_owed' => null,
            'location' => VehicleLocation::USA_OKLAHOMA->value,
            'price' => 145000,
            'description' => 'Premium SUV with commanding road presence and luxury drivability.',
            'images' => [
                'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1520050206274-a1ae446cb3cc?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?auto=format&fit=crop&w=800&q=80',
            ],
            'status' => VehicleStatus::RESERVED->value,
            'is_featured' => false,
        ]);

        Vehicle::create([
            'title' => 'Audi RS e-tron GT',
            'make' => 'Audi',
            'model' => 'e-tron GT',
            'trim' => 'RS',
            'year' => 2024,
            'mileage' => 3100,
            'vehicle_type' => VehicleType::LUXURY->value,
            'body_style' => BodyStyle::SEDAN->value,
            'exterior_color' => VehicleColor::GRAY->value,
            'interior_color' => VehicleColor::BLACK->value,
            'fuel_type' => FuelType::ELECTRIC->value,
            'transmission' => Transmission::AUTOMATIC->value,
            'has_clean_title' => true,
            'money_still_owed' => null,
            'location' => VehicleLocation::USA_OKLAHOMA->value,
            'price' => 104500,
            'description' => 'Electric sport sedan built for comfort, speed, and modern showroom appeal.',
            'images' => [
                'https://images.unsplash.com/photo-1617531653332-bd46c24f2068?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=800&q=80',
            ],
            'status' => VehicleStatus::AVAILABLE->value,
            'is_featured' => false,
        ]);
    }
}
