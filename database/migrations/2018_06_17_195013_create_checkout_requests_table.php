<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phoneNo');
            $table->string('tillNo');
            $table->integer('amount');
            $table->string('transactionRef');
            $table->string('transactionDesc');
            $table->string('merchantReqid');
            $table->string('checkoutId');
            $table->string('responsecode');
            $table->string('responseDesc');
            $table->string('customermsg');
            $table->integer('estate')->unsigned();
            $table->foreign('estate')->references('id')->on('estates')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user')->unsigned();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('checkout_requests');
    }
}
