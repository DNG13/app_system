<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_volunteers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
            $table->string('first_name', 64);
            $table->string('surname', 64);
            $table->string('nickname', 100);
            $table->date('birthday');
            $table->string('city', 100);
            $table->string('phone', 64);
            $table->json('social_links')->nullable();
            $table->string('status', 100);
            $table->text('experience')->nullable();
            $table->text('skills');
            $table->text('difficulties')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_volunteers');
    }
}
