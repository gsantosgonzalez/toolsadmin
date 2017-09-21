<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('responsible')->unsigned();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('responsible')->references('id')->on('cat_employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_areas');
    }
}
