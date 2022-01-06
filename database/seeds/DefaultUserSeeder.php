<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Profile;
use App\Models\UserRole;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'nataljasimple@gmail.com',
            'password' => '$2y$10$5.voPgq.H5kmBO7dsHN5mu4yl/EaClGt.g7WISOfGhaGTGIGJtIF6',
            'created_at' => gmdate('Y-m-d H:i:s'),
            'confirmed_at' => gmdate('Y-m-d H:i:s'),
            'confirmation_code'=> [],
        ]);
        Profile::create([
            'user_id' => $user->id,
            'first_name' => 'Admin',
            'surname' => 'Main',
            'nickname' => 'Main Admin',
            'birthday' => gmdate('Y-m-d H:i:s'),
            'created_at' => gmdate('Y-m-d H:i:s'),
            'social_links' => '{"vk":null,"in":null,"fb":null,"sk":null,"tg":null}'

        ]);
        UserRole::create([
            'user_id' => $user->id,
            'key' => 'admin',
        ]);

        $user = User::create([
            'email' => 'iigkey@gmail.com',
            'password' => '$2y$10$Q0XwYp23CD.KDCSc9J.KqufCFwHB/gFHyTkAjXDAeoju7lt9HW3vO',
            'created_at' => gmdate('Y-m-d H:i:s'),
            'confirmed_at' => gmdate('Y-m-d H:i:s'),
            'confirmation_code'=> [],
        ]);
        Profile::create([
            'user_id' => $user->id,
            'first_name' => 'Sky',
            'surname' => 'Wind',
            'nickname' => 'SkyWind',
            'birthday' => gmdate('Y-m-d H:i:s'),
            'created_at' => gmdate('Y-m-d H:i:s'),
            'social_links' => '{"vk":null,"in":null,"fb":null,"sk":null,"tg":null}'

        ]);
        UserRole::create([
            'user_id' => $user->id,
            'key' => 'admin',
        ]);

    }
}
