<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsPipeProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications_pipe_productions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("pipe_type_id")->unsigned();
            $table->integer("warehouse_id")->unsigned();
            $table->float("length_one_pipe")->comment("длина одной трубы");
            $table->integer("number")->comment("необходимое кол-во труб");
            $table->bigInteger("user_id")->unsigned()->comment("пользователь создавший заявку");
            $table->date("application_date")->comment("дата заявки");
            $table->smallInteger("status")->default(0);
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
        Schema::dropIfExists('applications_pipe_productions');
    }
}
