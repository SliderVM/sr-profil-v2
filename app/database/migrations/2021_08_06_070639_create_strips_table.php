<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buhta_id')->unsigned()->nullable();
            $table->bigInteger('brigade_id')->unsigned()->nullable();
            $table->integer('warehouse_id')->unsigned();
            $table->integer('metal_thicknesse_id')->unsigned();
            $table->bigInteger('types_metal_id')->unsigned();
            $table->bigInteger('counterpartie_id')->unsigned()->nullable();
            
            $table->integer('length_in_meters');
            $table->integer('width_in_millimeters');
            $table->float('weight_in_tons');
            $table->decimal('cost');
            $table->date('date_manufacture');
            $table->integer('available');
            $table->timestamps();

            $table->foreign('buhta_id')->references('id')->on('buhtas')->onDelete('cascade');
            $table->foreign('brigade_id')->references('id')->on('brigades')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('metal_thicknesse_id')->references('id')->on('metal_thicknesses')->onDelete('cascade');
            $table->foreign('types_metal_id')->references('id')->on('types_metals')->onDelete('cascade');
            $table->foreign('counterpartie_id')->references('id')->on('counterparties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strips');
    }
}
