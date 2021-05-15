<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuhtasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buhtas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('warehouse_id');
            $table->string('name');
            $table->unsignedBigInteger('counterparty_id')->comment = 'Контрагент';
            $table->unsignedBigInteger('type_metal_id');
            $table->unsignedInteger('metal_thickness_id');
            $table->integer('width')->comment = 'Ширина';
            $table->integer('weight')->comment = 'Вес';
            $table->integer('length');
            $table->decimal('price');
            $table->tinyInteger('available');
            $table->timestamps($precision = 0);

            $table->foreign('type_metal_id')->references('id')->on('types_metals');
            $table->foreign('metal_thickness_id')->references('id')->on('metal_thicknesses');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('counterparty_id')->references('id')->on('counterparties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buhtas');
    }
}
