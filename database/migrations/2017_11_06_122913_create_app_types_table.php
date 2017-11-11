<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('app_type', 64);
            $table->integer('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_types');
    }
}
