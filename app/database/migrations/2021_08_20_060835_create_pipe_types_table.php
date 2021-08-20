<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePipeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipe_types', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->integer('metal_thicknesse_id')->unsigned();
            $table->integer('width_strip_in_millimeters');
            $table->bigInteger('types_metal_id')->unsigned();
            $table->double('coefficient', 15, 8);
            $table->double('thickness_in_millimeters');
            $table->integer('pipe_in_pack');
            $table->timestamps();

            $table->foreign('metal_thicknesse_id')->references('id')->on('metal_thicknesses')->onDelete('cascade');
            $table->foreign('types_metal_id')->references('id')->on('types_metals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pipe_types');
    }
}
