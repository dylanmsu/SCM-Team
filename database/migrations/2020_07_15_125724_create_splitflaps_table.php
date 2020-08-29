<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSplitflapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('splitflaps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('board', array('A', 'B'));
            $table->enum('align', array('left','center','right'))->nullable();
            $table->string('first_text', 14)->nullable();
            $table->string('second_text', 14)->nullable();
            $table->integer('icon_index')->nullable();
            $table->timestamp('time');
            $table->unsignedBigInteger('creator');
            $table->foreign('creator')->references('id')->on('users');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('splitflaps');
    }
}
