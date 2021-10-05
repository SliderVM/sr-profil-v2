<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("pipe_type_id")->unsigned();
            $table->integer('warehouse_id')->unsigned();
            $table->bigInteger("pipe_quality_id")->unsigned();
            $table->float("length_one_pipe")->comment("длина одной трубы");
            $table->integer("number")->comment("количество труб на складе");
            $table->timestamps();

            $table->foreign('pipe_type_id')->references('id')->on('pipe_types')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('pipe_quality_id')->references('id')->on('pipe_qualities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pipes');
    }
}
