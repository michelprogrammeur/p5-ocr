<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        //$this->call(TaxrefTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ObservationsTableSeeder::class);
        $this->call(PicturesTableSeeder::class);
    }
}
