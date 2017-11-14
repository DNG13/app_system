<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppFairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_fairs', function (Blueprint $table) {
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
            $table->string('group_nick', 100);
            $table->string('contact_name', 255);
            $table->integer('members_count');
            $table->string('phone', 64);
            $table->text('social_link');
            $table->text('group_link');
            $table->json('equipment');
            $table->string('payment_type', 64);
            $table->float('square', 4, 2);
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_fairs');
    }
}
