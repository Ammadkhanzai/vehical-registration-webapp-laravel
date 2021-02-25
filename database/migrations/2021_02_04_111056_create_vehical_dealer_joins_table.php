<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicalDealerJoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehical_dealer_joins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vehical_id')->unsigned();
            $table->bigInteger('dealer_profile_id')->unsigned();
            $table->enum('receive',['false','true']);
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
        Schema::dropIfExists('vehical_dealer_joins');
    }
}
