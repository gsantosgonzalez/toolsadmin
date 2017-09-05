<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_tools', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tool_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->date('contract_date');
            $table->integer('license_number');
            $table->decimal('license_cost', 10, 2);
            $table->integer('frecuency_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('card_id')->unsigned();
            $table->boolean('status');

            $table->foreign('tool_id')->references('id')->on('tools')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('frecuency_id')->references('id')->on('frecuencies')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_tools');
    }
}
