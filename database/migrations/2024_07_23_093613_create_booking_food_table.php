<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingFoodTable extends Migration
{
    public function up()
    {
        Schema::create('booking_food', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->dateTime('order_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('status');
            $table->string('payment_method');
            $table->string('delivery_address');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_food');
    }
}
