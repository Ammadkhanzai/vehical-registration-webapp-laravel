<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicalUserJoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehical_user_joins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vehical_id')->unsigned();
            $table->bigInteger('user_profile_id')->unsigned();
            $table->enum('receive',['false','true']);
            $table->enum('owner',['false','true']);
            $table->bigInteger('last_owner')->unsigned()->nullable();
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
        Schema::dropIfExists('vehical_user_joins');
    }
}
