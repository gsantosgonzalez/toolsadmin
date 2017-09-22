<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('license_key');
            $table->integer('tool_id')->unsigned();
            $table->integer('frecuency_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('paymethod_id')->unsigned();
            $table->decimal('cost', 10, 2)->default(0.00);
            $table->date('contract_date');
            $table->date('cancel_date')->default(NULL);

            $table->foreign('tool_id')->references('id')->on('tools')->onDelete('cascade');
            $table->foreign('frecuency_id')->references('id')->on('cat_frecuencies')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('cat_currencies')->onDelete('cascade');
            $table->foreign('paymethod_id')->references('id')->on('cat_paymethods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}
