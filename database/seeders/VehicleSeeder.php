<?php

namespace Database\Seeders;

use App\Models\Enums\VehicleStatus;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BMW M4 Competition (Featured - Stock Local)
        Vehicle::create([
            'title' => 'BMW M4 Competition',
            'brand' => 'BMW',
            'model' => 'M4',
            'year' => 2024,
            'mileage' => 0,
            'fuel_type' => 'Gasoline',
            'transmission' => 'Automatic',
            'category' => 'Sports',
            'price' => 89950,
            'images' => [
                'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1607853202273-797f1c22a38e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1542282088-fe8426682b8f?auto=format&fit=crop&w=800&q=80'
            ],
            'status' => VehicleStatus::AVAILABLE_LOCAL,
            'location' => 'Afrique (Sur place)',
            'is_featured' => true,
        ]);

        // 2. Mercedes-Benz S-Class (Featured - Stock USA)
        Vehicle::create([
            'title' => 'Mercedes-Benz S-Class',
            'brand' => 'Mercedes-Benz',
            'model' => 'S-Class',
            'year' => 2024,
            'mileage' => 1200,
            'fuel_type' => 'Gasoline',
            'transmission' => 'Automatic',
            'category' => 'Luxury',
            'price' => 112350,
            'images' => [
                'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1616422285623-13ff0162193c?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
            ],
            'status' => VehicleStatus::AVAILABLE_USA,
            'location' => 'USA (Transit requis)',
            'is_featured' => true,
        ]);

        // 3. Tesla Model S Plaid (Featured - En Transit)
        Vehicle::create([
            'title' => 'Tesla Model S Plaid',
            'brand' => 'Tesla',
            'model' => 'Model S',
            'year' => 2024,
            'mileage' => 0,
            'fuel_type' => 'Electric',
            'transmission' => 'Automatic',
            'category' => 'Electric',
            'price' => 94990,
            'images' => [
                'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1548883354-7622d03aca27?auto=format&fit=crop&w=800&q=80'
            ],
            'status' => VehicleStatus::IN_TRANSIT,
            'location' => 'En mer (Arrivée bientôt)',
            'is_featured' => true,
        ]);

        // 4. Porsche 911 GT3 RS (VENDU - Exemple pour la section des véhicules déjà vendus)
        Vehicle::create([
            'title' => 'Porsche 911 GT3 RS',
            'brand' => 'Porsche',
            'model' => '911 GT3',
            'year' => 2025,
            'mileage' => 150,
            'fuel_type' => 'Gasoline',
            'transmission' => 'Automatic',
            'category' => 'Sports',
            'price' => 223000,
            'images' => [
                'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1611245555447-e8025bc769cd?auto=format&fit=crop&w=800&q=80'
            ],
            'status' => VehicleStatus::SOLD,
            'location' => 'Libréville (Livré)',
            'is_featured' => false,
        ]);

        // 5. Range Rover Autobiography (Stock Local)
        Vehicle::create([
            'title' => 'Range Rover Autobiography',
            'brand' => 'Land Rover',
            'model' => 'Range Rover',
            'year' => 2025,
            'mileage' => 0,
            'fuel_type' => 'Hybrid',
            'transmission' => 'Automatic',
            'category' => 'SUV',
            'price' => 145000,
            'images' => [
                'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1520050206274-a1ae446cb3cc?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=800&q=80'
            ],
            'status' => VehicleStatus::AVAILABLE_LOCAL,
            'location' => 'Afrique (Sur place)',
            'is_featured' => false,
        ]);

        // 6. Audi RS e-tron GT (En Transit)
        Vehicle::create([
            'title' => 'Audi RS e-tron GT',
            'brand' => 'Audi',
            'model' => 'e-tron GT',
            'year' => 2024,
            'mileage' => 3100,
            'fuel_type' => 'Electric',
            'transmission' => 'Automatic',
            'category' => 'Electric',
            'price' => 104500,
            'images' => [
                'https://images.unsplash.com/photo-1617531653332-bd46c24f2068?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80'
            ],
            'status' => VehicleStatus::IN_TRANSIT,
            'location' => 'En mer',
            'is_featured' => false,
        ]);
    }
}