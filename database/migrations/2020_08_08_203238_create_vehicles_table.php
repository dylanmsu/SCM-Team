<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('category'); //motorwagen, diesellocomotief, stoomlocomotief, werfvoertuig, rijtuig, wagen, Andere
            $table->string('name');
            $table->enum('state', ['in_dienst', 'buiten_dienst', 'in_reserve', 'onder_voorwaarde', 'andere']);
            $table->string('comment')->nullable();
            $table->enum('type', ['normaal', 'smal']);
            $table->string('test');
            $table->timestamps();
        });
    }

    /*
    INSERT INTO vehicles (category, name, state, type) VALUES ('motorwagen', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('motorwagen', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('motorwagen', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('diesellocomotief', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('stoomlocomotief', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('stoomlocomotief', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('stoomlocomotief', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('werfvoertuig', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('werfvoertuig', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('werfvoertuig', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('werfvoertuig', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('werfvoertuig', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('rijtuig', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('rijtuig', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('wagen', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('wagen', 'DL595', 'in_dienst', 'normaal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('diesellocomotief', 'DL4021', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('diesellocomotief', 'DL4658', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('diesellocomotief', 'DL4221', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('diesellocomotief', 'DL4021', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('stoomlocomotief', 'DL548', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('stoomlocomotief', 'DL544', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('stoomlocomotief', 'DL595', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('rijtuig', 'DL595', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('rijtuig', 'DL595', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('rijtuig', 'DL595', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('rijtuig', 'DL595', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('rijtuig', 'DL595', 'in_dienst', 'smal');
    INSERT INTO vehicles (category, name, state, type) VALUES ('andere', 'DL595', 'in_dienst', 'smal');
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
