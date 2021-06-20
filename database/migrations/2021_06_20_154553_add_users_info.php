<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->date('birth_day')->nullable();
            $table->string('birth_place');
            $table->string('address');
            $table->bigInteger('postal_code');
            $table->string('residence');
            $table->string('province');
            $table->string('country');
            $table->string('mobile_phone');
            $table->string('phone')->nullable();
            $table->string('name_parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role_id',  'birth_day', 'birth_place', 
                'address',  'postal_code', 'residence', 
                'province',  'country', 'mobile_phone', 
                'phone', 'name_parent'
            ]);
        });
    }
}
