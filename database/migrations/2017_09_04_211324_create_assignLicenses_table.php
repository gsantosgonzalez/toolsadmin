<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('license_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('computer_id')->unsigned();
            $table->date('activation-date');
            $table->date('deactivation-date')->default(NULL);
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('cat_areas')->onDelete('cascade');
            $table->foreign('computer_id')->references('id')->on('cat_computers')->onDelete('cascade');
            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_licenses');
    }
}
