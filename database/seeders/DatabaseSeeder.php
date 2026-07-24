<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. D'abord créer les rôles et permissions Spatie
        $this->call(RolesAndPermissionsSeeder::class);

        // 2. Créer le compte Administrateur
        $admin = User::firstOrCreate(
            ['email' => 'admin@405groupauto.com'],
            [
                'name' => 'Admin 405',
                'password' => Hash::make('password'), // Change le mot de passe si besoin
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // 3. Créer le compte Utilisateur de test
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $testUser->assignRole('user');

        // 4. Charger la flotte de véhicules
        $this->call(VehicleSeeder::class);
    }
}
