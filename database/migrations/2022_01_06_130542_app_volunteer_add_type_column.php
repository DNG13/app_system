<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppVolunteerAddTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app('db')->statement("INSERT INTO app_types (title, app_type, created_at) VALUES ('Волонтер', 'volunteer', NOW());");

        Schema::table('app_volunteers', function (Blueprint $table) {
            $table->integer('type_id');
            $table->foreign('type_id')->references('id')->on('app_types');
        });

        app('db')->statement("UPDATE app_volunteers SET type_id = (SELECT id from app_types WHERE title = 'Волонтер')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_volunteers', function (Blueprint $table) {
            $table->dropColumn('type_id');
        });

        app('db')->statement("DELETE FROM app_types WHERE title = 'Волонтер';");
    }
}
