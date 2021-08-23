<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStripsTransferHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strips_transfer_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("strips_id")->unsigned();
            $table->integer("outgoing_warehouse_id")->unsigned();
            $table->integer("incoming_warehouse_id")->unsigned();
            $table->bigInteger("user_sending_id")->unsigned();
            $table->bigInteger("user_receipt_id")->nullable()->unsigned();
            $table->date("date_sending");
            $table->date("date_receipt")->nullable();
            $table->timestamps();

            $table->foreign('strips_id')->references('id')->on('strips')->onDelete('cascade');
            $table->foreign('outgoing_warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('incoming_warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('user_sending_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_receipt_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strips_transfer_histories');
    }
}
