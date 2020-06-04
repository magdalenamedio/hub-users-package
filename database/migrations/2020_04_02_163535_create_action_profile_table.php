<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('hub-users-databases.local-connection'))->create('action_profile', function (Blueprint $table) {
            $table->bigInteger('profile_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('module_id')->unsigned();
            $table->bigInteger('action_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade'); 
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_profile');
    }
}
