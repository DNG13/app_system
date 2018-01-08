<?php

use Illuminate\Database\Seeder;
use App\Models\AppType;

class App_types_pressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [
            'Фото',
            'Видео',
            'Прочее'
        ];
        for ($i=0, $count=count($titles); $i < $count; $i++) {
            AppType::create([
                'app_type' => 'press',
                'title' => $titles[$i],
                'created_at' => '2018-01-08 12:37:00',
            ]);
        };
    }
}
