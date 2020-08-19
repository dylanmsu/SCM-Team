<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vehicle')->unsigned();
            $table->foreign('id_vehicle')->references('id')->on('vehicles');
            $table->text('remarks')->nullable();
            $table->enum('state', ['actief', 'in_onderzoek', 'afgewerkt', 'andere']);
            $table->integer('creator')->unsigned();
            $table->foreign('creator')->references('id')->on('users');
            $table->integer('editor')->unsigned()->nullable();
            $table->foreign('editor')->references('id')->on('users');
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
        Schema::dropIfExists('vehicles_comments');
    }
}
