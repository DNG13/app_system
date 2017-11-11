<?php

use Illuminate\Database\Seeder;
use App\Models\App_type;

class App_types_cosplayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [ 'Сценическая Постановка',
            'Дефиле',
            'Групповое Дефиле',
            'Караоке',
            'Танец',
            'K-Pop',
            'Светошоу',
            'Прочее',
            'Внеконкурсa'];
        for ($i=0, $count=count($titles); $i < $count; $i++) {
            App_type::create([
                'app_type' => 'cosplay',
                'title' => $titles[$i],
                'created_at' => Carbon\Carbon::now(),
            ]);
        };
    }
}
