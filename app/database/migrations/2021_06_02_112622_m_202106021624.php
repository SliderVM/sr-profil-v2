<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class M202106021624 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $wt = new App\Models\WarehouseType();
        $wt->name = "Бухты";
        $wt->table_name = "buhtas";
        $wt->save();

        $wt = new App\Models\WarehouseType();
        $wt->name = "Штрипс";
        $wt->table_name = "strips";
        $wt->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
