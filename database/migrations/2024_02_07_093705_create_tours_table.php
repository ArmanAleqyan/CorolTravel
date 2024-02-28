<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('vilet_city_id')->nullable();
            $table->string('kurort')->nullable();
            $table->date('date_start')->nullable();
            $table->string('night_count')->nullable();
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('new_price')->nullable();
            $table->string('price_description')->nullable();
            $table->string('in_price_text')->nullable();
            $table->string('republick_name')->nullable();
            $table->longText('republic_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
