<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usersupdatetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('wallet')->default('0');
            $table->string('region');
            $table->string('province');
            $table->string('municipal');
            $table->string('brgy');
            $table->renameColumn('address', 'street_add');
            $table->string('active')->default('0');
            $table->string('addresstype')->default('0');
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
