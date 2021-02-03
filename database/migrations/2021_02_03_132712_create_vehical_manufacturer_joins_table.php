<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicalManufacturerJoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehical_manufacturer_joins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vehical_id')->unsigned();
            $table->bigInteger('manufacturer_profile_id')->unsigned();
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
        Schema::dropIfExists('vehical_manufacturer_joins');
    }
}
