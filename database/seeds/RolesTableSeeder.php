<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'key' => 'admin',
            'title' => 'Координаторы фестиваля',
            'created_at' => Carbon\Carbon::now(),
            'active' => true,
        ]);

    }
}
