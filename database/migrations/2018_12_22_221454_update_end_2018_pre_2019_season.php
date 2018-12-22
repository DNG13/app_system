<?php

use Illuminate\Database\Migrations\Migration;

class UpdateEnd2018Pre2019Season extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app('db')->statement('ALTER TABLE app_files ALTER COLUMN app_id DROP NOT NULL');
        app('db')->statement('ALTER TABLE app_files ADD temp_id VARCHAR(255)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app('db')->statement('ALTER TABLE app_files DROP COLUMN temp_id');
    }
}
