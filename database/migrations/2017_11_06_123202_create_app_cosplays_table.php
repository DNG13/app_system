<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppCosplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_cosplays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('type_id');
            $table->foreign('type_id')
                ->references('id')->on('app_types');
            $table->timestamps();
            $table->json('members');
            $table->integer('members_count');
            $table->string('title', 100);
            $table->string('fandom', 255);
            $table->integer('length');
            $table->text('description');
            $table->string('city', 100);
            $table->string('status', 100);
            $table->text('comment')->nullable();
            $table->text('prev_part')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_cosplays');
    }
}
