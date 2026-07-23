<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reinitialiser le cache des rôles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Créer les rôles si absents
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole  = Role::firstOrCreate(['name' => 'user']);

        // 2. Assigner le rôle 'admin' à l'utilisateur Administrateur
        $admin = User::where('email', 'admin@405groupauto.com')->first();
        if ($admin) {
            $admin->assignRole($adminRole);
        }

        // 3. Assigner le rôle 'user' à l'utilisateur de test
        $testUser = User::where('email', 'test@example.com')->first();
        if ($testUser) {
            $testUser->assignRole($userRole);
        }
    }
}