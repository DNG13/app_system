<?php

use Illuminate\Database\Seeder;
use App\Models\AppType;

class App_types_fairTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [
            'Магазин',
            'Хендмейд',
            'Художник',
            'Писатель',
            'Мангака',
            'Коммерческий стенд',
            'Фанатский стенд',
            'Игровая зона',
            'Фудкорт',
            'Прочее'
        ];
        for ($i=0, $count=count($titles); $i < $count; $i++) {
            AppType::create([
                'app_type' => 'fair',
                'title' => $titles[$i],
                'created_at' => Carbon\Carbon::now(),
            ]);
        };
    }
}
