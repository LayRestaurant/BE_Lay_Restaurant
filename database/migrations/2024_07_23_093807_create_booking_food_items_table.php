<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingFoodItemsTable extends Migration
{
    public function up()
    {
        Schema::create('booking_food_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_food')->onDelete('cascade');
            $table->foreignId('food_id')->constrained('food')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_food_items');
    }
}
