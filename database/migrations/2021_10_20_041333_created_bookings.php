<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('rider_id');
            $table->integer('vehicle_id');
            $table->string('booking_amount');
            $table->string('tax')->nullable();
            $table->string('total_booking_amount');
            $table->integer('status')->default('0');
            $table->timestamp('booking_date_time');	
            $table->timestamp('schedule_date_time')->nullable();
            $table->timestamp('complete_date_time')->nullable();
            $table->timestamp('cancel_date_time')->nullable();            
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
