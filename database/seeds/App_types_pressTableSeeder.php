<?php

use Illuminate\Database\Seeder;
use App\Models\App_type;

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
            App_type::create([
                'app_type' => 'press',
                'title' => $titles[$i],
                'created_at' => Carbon\Carbon::now(),
            ]);
        };
    }
}
