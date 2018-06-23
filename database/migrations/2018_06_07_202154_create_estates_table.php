<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('county');
            $table->string('town');
            $table->string('area');
            $table->string('more_info')->nullable();
            $table->integer('landlord')->unsigned();
            $table->foreign('landlord')->references('id')->on('landlords')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('totalrooms');
            $table->integer('availablerooms');
            $table->string('type');
            $table->float('price');
            $table->string('period')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
            $table->timestamps();
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estates');
    }
}
