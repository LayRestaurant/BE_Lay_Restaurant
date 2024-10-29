<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->bigIncrements('id'); // Unique identifier for the booking (Primary Key)
            $table->unsignedBigInteger('guest_id'); // Reference to the guest who made the booking
            $table->unsignedBigInteger('room_id'); // Reference to the cabin being booked
            $table->dateTime('check_in_date'); // Start date of the booking (DateTime)
            $table->dateTime('check_out_date'); // End date of the booking (DateTime)
            $table->integer('number_of_days'); // Number of nights for the booking (Integer)
            $table->integer('number_of_guests'); // Number of guests (Integer)
            $table->decimal('total_price', 10, 2); // Total price for the booking (Decimal)
            $table->string('status')->default('booked'); // Status of the booking (e.g., 'checked-in', 'cancelled', etc.)
            $table->text('notes')->nullable(); // Any additional notes related to the booking (Text)
            $table->boolean('payment_status')->default(false); // Payment status
            $table->timestamps(); // Created at and Updated at timestamps

            // Foreign key constraints
            $table->foreign('guest_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_rooms');
    }
}
