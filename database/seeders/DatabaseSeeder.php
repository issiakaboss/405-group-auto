<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer un compte Administrateur
        User::factory()->create([
            'name' => 'Admin 405',
            'email' => 'admin@405groupauto.com',
        ]);

        // 2. Créer un compte Utilisateur normal
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 3. Assigner les rôles Spatie (Admin & User)
        $this->call(RolesAndPermissionsSeeder::class);

        // 4. Charger la flotte de véhicules
        $this->call(VehicleSeeder::class);
    }
}
