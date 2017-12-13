<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->string('app_kind');
            $table->text('link');
            $table->text('thumbnail_link')->nullable();
            $table->string('name', 255);
            $table->string('type', 64);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_files');
    }
}
