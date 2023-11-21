<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::create([
            'username' => 'admin',
            'name' => 'OUEDRAOGO',
            'forname' => 'David',
            'code_dir' => 2,
            'owner' => 0,
            'password' => Hash::make('Ocades@2021'),
        ]);

        $secretaire = User::create([
            'username' => 'gestionnaire',
            'name' => 'SANFO',
            'forname' => 'Alphonse',
            'code_dir' => 1,
            'owner' => 1,
            'password' => Hash::make('Ocades@2021'),
        ]);

        $utilisateur = User::create([
            'username' => 'utilisateur',
            'name' => 'KOANDA',
            'forname' => 'Aziz',
            'code_dir' => 1,
            'owner' => 2,
            'password' => Hash::make('Ocades@2021'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $utilisateurRole = Role::where('name', 'utilisateur')->first();
        $gestionnaireRole = Role::where('name', 'gestionnaire')->first();

        $admin->roles()->attach($adminRole);
        $secretaire->roles()->attach($gestionnaireRole);
        $utilisateur->roles()->attach($utilisateurRole);
    }
}
