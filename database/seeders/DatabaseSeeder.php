<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. D'ABORD créer les rôles et permissions Spatie
        $this->call(RolesAndPermissionsSeeder::class);

        // 2. Créer le compte Administrateur
        $admin = User::factory()->create([
            'name' => 'Admin 405',
            'email' => 'admin@405groupauto.com',
        ]);
        $admin->assignRole('admin');

        // 3. Créer le compte Utilisateur normal
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $testUser->assignRole('user');

        // 4. Charger la flotte de véhicules
        $this->call(VehicleSeeder::class);
    }
}