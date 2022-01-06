<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppTypesAddColumnSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_types', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        app('db')->statement("UPDATE app_types SET slug = 'scenic' WHERE title = 'Сценическая Постановка'");
        app('db')->statement("UPDATE app_types SET slug = 'defile' WHERE title = 'Дефиле'");
        app('db')->statement("UPDATE app_types SET slug = 'defile_group' WHERE title = 'Групповое Дефиле'");
        app('db')->statement("UPDATE app_types SET slug = 'sing' WHERE title = 'Караоке'");
        app('db')->statement("UPDATE app_types SET slug = 'dance' WHERE title = 'Танец'");
        app('db')->statement("UPDATE app_types SET slug = 'kpop' WHERE title = 'K-Pop'");
        app('db')->statement("UPDATE app_types SET slug = 'lightshow' WHERE title = 'Светошоу'");
        app('db')->statement("UPDATE app_types SET slug = 'other_cosplay' WHERE title = 'Прочее' AND app_type = 'cosplay'");
        app('db')->statement("UPDATE app_types SET slug = 'out_of_competition' WHERE title = 'Внеконкурс'");
        app('db')->statement("UPDATE app_types SET slug = 'shop' WHERE title = 'Магазин'");
        app('db')->statement("UPDATE app_types SET slug = 'handmade' WHERE title = 'Хендмейд'");
        app('db')->statement("UPDATE app_types SET slug = 'artist' WHERE title = 'Художник'");
        app('db')->statement("UPDATE app_types SET slug = 'writer' WHERE title = 'Писатель'");
        app('db')->statement("UPDATE app_types SET slug = 'manga_artist' WHERE title = 'Мангака'");
        app('db')->statement("UPDATE app_types SET slug = 'commerce_spot' WHERE title = 'Коммерческий стенд'");
        app('db')->statement("UPDATE app_types SET slug = 'fan_spot' WHERE title = 'Фанатский стенд'");
        app('db')->statement("UPDATE app_types SET slug = 'game_zone' WHERE title = 'Игровая зона'");
        app('db')->statement("UPDATE app_types SET slug = 'food' WHERE title = 'Фудкорт'");
        app('db')->statement("UPDATE app_types SET slug = 'other_fair' WHERE title = 'Прочее' AND app_type = 'fair'");
        app('db')->statement("UPDATE app_types SET slug = 'photo' WHERE title = 'Фото'");
        app('db')->statement("UPDATE app_types SET slug = 'video' WHERE title = 'Видео'");
        app('db')->statement("UPDATE app_types SET slug = 'other_press' WHERE title = 'Прочее' AND app_type = 'press'");
        app('db')->statement("UPDATE app_types SET slug = 'volunteer_general' WHERE title = 'Волонтер'");

        app('db')->statement("UPDATE app_types SET title = 'Сценічна постановка' WHERE title = 'Сценическая Постановка'");
        app('db')->statement("UPDATE app_types SET title = 'Дефіле' WHERE title = 'Дефиле'");
        app('db')->statement("UPDATE app_types SET title = 'Групове Дефіле' WHERE title = 'Групповое Дефиле'");
        app('db')->statement("UPDATE app_types SET title = 'Танок' WHERE title = 'Танец'");
        app('db')->statement("UPDATE app_types SET title = 'Світлове шоу' WHERE title = 'Светошоу'");
        app('db')->statement("UPDATE app_types SET title = 'Інше' WHERE title = 'Прочее'");
        app('db')->statement("UPDATE app_types SET title = 'Поза конкурсом' WHERE title = 'Внеконкурс'");
        app('db')->statement("UPDATE app_types SET title = 'Письменник' WHERE title = 'Писатель'");
        app('db')->statement("UPDATE app_types SET title = 'Комерційний стенд' WHERE title = 'Коммерческий стенд'");
        app('db')->statement("UPDATE app_types SET title = 'Фанатський стенд' WHERE title = 'Фанатский стенд'");
        app('db')->statement("UPDATE app_types SET title = 'Ігрова зона' WHERE title = 'Игровая зона'");
        app('db')->statement("UPDATE app_types SET title = 'Відео' WHERE title = 'Видео'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_types', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        app('db')->statement("UPDATE app_types SET title = 'Сценическая Постановка' WHERE title = 'Сценічна постановка'");
        app('db')->statement("UPDATE app_types SET title = 'Дефиле' WHERE title = 'Дефіле'");
        app('db')->statement("UPDATE app_types SET title = 'Групповое Дефиле' WHERE title = 'Групове Дефіле'");
        app('db')->statement("UPDATE app_types SET title = 'Танец' WHERE title = 'Танок'");
        app('db')->statement("UPDATE app_types SET title = 'Светошоу' WHERE title = 'Світлове шоу'");
        app('db')->statement("UPDATE app_types SET title = 'Прочее' WHERE title = 'Інше'");
        app('db')->statement("UPDATE app_types SET title = 'Внеконкурс' WHERE title = 'Поза конкурсом'");
        app('db')->statement("UPDATE app_types SET title = 'Писатель' WHERE title = 'Письменник'");
        app('db')->statement("UPDATE app_types SET title = 'Коммерческий стенд' WHERE title = 'Комерційний стенд'");
        app('db')->statement("UPDATE app_types SET title = 'Фанатский стенд' WHERE title = 'Фанатський стенд'");
        app('db')->statement("UPDATE app_types SET title = 'Игровая зона' WHERE title = 'Ігрова зона'");
        app('db')->statement("UPDATE app_types SET title = 'Видео' WHERE title = 'Відео'");
    }
}
