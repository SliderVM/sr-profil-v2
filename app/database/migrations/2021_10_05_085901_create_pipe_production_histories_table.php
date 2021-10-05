<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePipeProductionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipe_production_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("pipe_type_id")->unsigned();
            $table->integer("warehouse_id")->unsigned();
            $table->bigInteger("pipe_quality_id")->unsigned();
            $table->bigInteger("brigade_id")->unsigned();
            $table->float("length_one_pipe")->comment("длина одной трубы");
            $table->integer("number")->comment("количество произведенных труб");
            $table->date("production_date")->comment("дата производства");
            $table->timestamps();

            $table->foreign('pipe_type_id')->references('id')->on('pipe_types')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('pipe_quality_id')->references('id')->on('pipe_qualities')->onDelete('cascade');
            $table->foreign('brigade_id')->references('id')->on('brigades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pipe_production_histories');
    }
}
