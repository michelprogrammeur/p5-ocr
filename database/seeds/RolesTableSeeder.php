<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_visiteur = new Role();
        $role_visiteur->name = 'visiteur';
        $role_visiteur->description = 'A visiteur User';
        $role_visiteur->save();

        $role_colaborateur = new Role();
        $role_colaborateur->name = 'colaborateur';
        $role_colaborateur->description = 'A colaborateur User';
        $role_colaborateur->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'A Admin User';
        $role_admin->save();
    }
}
