<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('regularPrice', 10, 2); // Adding regular price field
            $table->integer('maxCapacity'); // Adding maximum capacity field
            $table->decimal('price', 10, 2)->nullable(); // Price field, optional
            $table->integer('discount')->default(0); // Discount field, defaulting to 0
            $table->enum('status', ['available', 'booked']);
            $table->integer('star_rating')->default(0);
            $table->enum('room_type', ['single', 'double', 'multiple']);
            $table->boolean('most_booked_room')->default(false);
            $table->string('restaurant_name')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image')->nullable(); // Adding main image field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
