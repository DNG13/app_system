<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app('db')->statement("CREATE TABLE user_roles (            
        user_id INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
        key VARCHAR NOT NULL REFERENCES roles(key) ON UPDATE CASCADE ON DELETE CASCADE,
        PRIMARY KEY  (user_id, key)
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app('db')->statement("DROP TABLE IF EXISTS user_roles");
    }
}