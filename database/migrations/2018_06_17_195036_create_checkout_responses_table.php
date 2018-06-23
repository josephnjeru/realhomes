<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->string('merchantReqid');
            $table->string('checkoutId');
            $table->string('resultcode'); 
            $table->string('resultDesc');
            $table->integer('amount')->nullable();
            $table->string('mpesaRecieptNo')->nullable();
            $table->string('transactiondate')->nullable();
            $table->string('phoneNo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_responses');
    }
}
