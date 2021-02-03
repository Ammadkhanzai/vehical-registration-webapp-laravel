<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->string('color')->nullable();
            $table->string('maker')->nullable();
            $table->string('engine_number')->unique();
            $table->string('chassis_number');
            $table->string('engine_capacity')->nullable();
            $table->string('vehical_class')->nullable();
            $table->string('transmission')->nullable();
            $table->text('interior_features')->nullable();
            $table->text('exterior_features')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('safety')->nullable();
            $table->string('seating_capacity')->nullable();
            $table->enum('state',['fresh','sold']);
            $table->enum('status',['under_manufacturer','under_dealer','under_user']);
            $table->softDeletes();
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
        Schema::dropIfExists('vehicals');
    }
}
