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
        $this->call(App_types_cosplayTableSeeder::class);
        $this->call(App_types_fairTableSeeder::class);
        $this->call(App_types_pressTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
