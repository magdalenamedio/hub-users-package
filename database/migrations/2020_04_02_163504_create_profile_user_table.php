<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('hub-users-databases.local-connection'))->create('profile_user', function (Blueprint $table) {
            
            $table->bigInteger('hub_user_id')->unsigned();
            $table->bigInteger('profile_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();  
            $table->timestamps();
        
            $table->foreign('hub_user_id')->references('id')->on('hub_users')->onDelete('cascade'); 
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade'); 
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_user');
    }
}