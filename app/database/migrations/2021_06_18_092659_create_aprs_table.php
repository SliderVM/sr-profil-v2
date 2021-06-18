<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buhta_id')->unsigned();
            $table->integer('width');
            $table->integer('amount');
            $table->integer('tonage');
            $table->timestamps();

            $table->foreign('buhta_id')->references('id')->on('buhtas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aprs');
    }
}
