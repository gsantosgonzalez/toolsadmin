<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->integer('type_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('responsible_id')->unsigned();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('responsible_id')->references('id')->on('responsibles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools');
    }
}
