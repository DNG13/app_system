<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->string('key', 20);
            $table->primary('key');
            $table->string('title', 100);
            $table->timestamps();
            $table->boolean('active');
        });

        app('db')->statement("INSERT INTO roles (key, title, active) VALUES ('admin', 'Admin', true)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
