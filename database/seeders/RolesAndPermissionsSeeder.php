<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Créer le rôle Admin si absent
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Trouve ton utilisateur (par exemple ID 1 ou ton email actuel) et donne-lui le rôle
        $user = User::find(2); // Récupère le tout premier utilisateur inscrit
        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}