<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_infos', function (Blueprint $table) {
            $table->id();
            $table->string('rider_id');
            $table->string('motor_brand');
            $table->string('motor_model');
            $table->string('motor_year');
            $table->string('or');
            $table->string('cr');
            $table->string('license_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_infos');
    }
}
