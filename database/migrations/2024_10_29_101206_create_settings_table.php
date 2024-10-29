<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // Cột ID duy nhất
            $table->string('theme'); // Cột cho kiểu chủ đề
            $table->string('language'); // Cột cho ngôn ngữ
            $table->boolean('notifications_enabled')->default(true); // Cột cho trạng thái thông báo
            $table->integer('max_items')->default(50); // Cột cho số lượng tối đa của một số mục
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
