<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_visiteur = Role::where('name', 'visiteur')->first();
        $role_colaborateur  = Role::where('name', 'colaborateur')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        // Visiteur
        $visiteur = new User();
        $visiteur->pseudo = 'Visiteur123';
        $visiteur->firstname = 'Paul';
        $visiteur->lastname = 'visiteur';
        $visiteur->job = 'vendeur';
        $visiteur->phone = '0600000000';
        $visiteur->email = 'visiteur@example.com';
        $visiteur->password = bcrypt('secret');
        $visiteur->confirmation_token = str_random(10);
        $visiteur->remember_token = str_random(10);
        $visiteur->save();
        $visiteur->roles()->attach($role_visiteur);

        // Colaborateur
        $colaborateur = new User();
        $colaborateur->pseudo = 'Colaborateur123';
        $colaborateur->firstname = 'Jean';
        $colaborateur->lastname = 'colaborateur';
        $colaborateur->job = 'chasseur';
        $colaborateur->phone = '0600000000';
        $colaborateur->email = 'colaborateur@example.com';
        $colaborateur->password = bcrypt('secret');
        $colaborateur->confirmation_token = str_random(10);
        $colaborateur->remember_token = str_random(10);
        $colaborateur->save();
        $colaborateur->roles()->attach($role_colaborateur);

        // admin
        $admin = new User();
        $admin->pseudo = 'Admin123';
        $admin->firstname = 'Pierre';
        $admin->lastname = 'Admin';
        $admin->job = 'ornithologue';
        $admin->phone = '0600000000';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->confirmation_token = str_random(10);
        $admin->remember_token = str_random(10);
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
