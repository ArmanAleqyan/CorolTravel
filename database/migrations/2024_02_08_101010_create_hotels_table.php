<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('name')->nullable();
            $table->string('start_date')->nullable();
            $table->string('night_count')->nullable();
            $table->string('price')->nullable();
            $table->string('new_price')->nullable();
            $table->longText('text_one')->nullable();
            $table->longText('text_two')->nullable();
            $table->longText('text_three')->nullable();
            $table->longText('text_for')->nullable();
            $table->longText('text_five')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('hotels');
    }
}
