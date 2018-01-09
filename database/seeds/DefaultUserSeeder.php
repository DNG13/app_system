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
        User::create([
            'id' => '1',
            'email' => 'nataljasimple@gmail.com',
            'password' => '$2y$10$5.voPgq.H5kmBO7dsHN5mu4yl/EaClGt.g7WISOfGhaGTGIGJtIF6',
            'created_at' => '2018-01-08 12:37:30',
            'confirmed_at' => '2018-01-08 12:37:31',
            'confirmation_code'=> [],
        ]);
        Profile::create([
            'user_id' => '1',
            'first_name' => 'Admin',
            'surname' => 'Main',
            'nickname' => 'Main Admin',
            'birthday' => '2018-01-08 12:37:00',
            'created_at' => '2018-01-08 12:37:31',
            'social_links' => '{"vk":null,"in":null,"fb":null,"sk":null,"tg":null}'

        ]);
        UserRole::create([
            'user_id' => '1',
            'key' => 'admin',
        ]);

    }
}
