<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('avatar_id')->nullable();
            $table->string('first_name', 64);
            $table->string('surname', 64);
            $table->string('middle_name', 64)->nullable();
            $table->string('nickname', 100);
            $table->date('birthday')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('phone', 64)->nullable();
            $table->json('social_links')->nullable();
            $table->text('info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
