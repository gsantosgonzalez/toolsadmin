<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_contracts', function (Blueprint $table) {
            $table->integer('tool_id')->unsigned();
            $table->date('contract_date');
            $table->decimal('cost', 10, 2);
            $table->string('frecuency');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('tool_id')->references('id')->on('tools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_contracts');
    }
}
