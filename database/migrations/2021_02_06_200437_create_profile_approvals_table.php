<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_approvals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_role_join_id')->unsigned();
            $table->enum('status',['false','approved']);
            $table->enum('active',['false','true']);
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
        Schema::dropIfExists('profile_approvals');
    }
}
