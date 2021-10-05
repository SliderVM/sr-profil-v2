<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePipeTransferHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipe_transfer_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("pipe_type_id")->unsigned();
            $table->bigInteger("pipe_quality_id")->unsigned();
            $table->integer("outgoing_warehouse_id")->unsigned();
            $table->integer("incoming_warehouse_id")->unsigned();
            $table->float("length_one_pipe")->comment("длина одной трубы");
            $table->integer("number")->comment("количество перемещаемых труб");
            $table->bigInteger("user_sending_id")->unsigned();
            $table->bigInteger("user_receipt_id")->nullable()->unsigned();
            $table->date("date_sending");
            $table->date("date_receipt")->nullable();
            $table->timestamps();

            $table->foreign('outgoing_warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('incoming_warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('user_sending_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_receipt_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pipe_type_id')->references('id')->on('pipe_types')->onDelete('cascade');
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
        Schema::dropIfExists('history_pipe_movements');
    }
}
