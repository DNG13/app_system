<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_press', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('type_id');
            $table->foreign('type_id')
                ->references('id')->on('app_types')
                ->onDelete('cascade');
            $table->timestamps();
            $table->text('portfolio_link');
            $table->string('prev_part', 255)->nullable();
            $table->string('media_name', 100);
            $table->string('contact_name', 255);
            $table->json('members');
            $table->integer('members_count');
            $table->string('city', 100);
            $table->string('status', 100);
            $table->string('phone', 64);
            $table->text('social_link');
            $table->json('social_links');
            $table->string('camera', 100);
            $table->text('equipment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_press');
    }
}
