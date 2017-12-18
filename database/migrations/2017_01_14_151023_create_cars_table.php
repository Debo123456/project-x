<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->text('make');
            $table->string('model', 25)->default('Not specified');
            $table->integer('year');
            $table->integer('price');
            $table->string('img', 255)->unique();
            $table->string('seller', 255);
            $table->string('contact', 25);
            $table->string('location', 255)->default('Not specified');
            $table->string('transmission', 25)->default('Not specified');
            $table->integer('mileage')->nullable();
            $table->longText('description');
            $table->string('condition', 25);
            $table->string('body_type', 25)->default('Not specified');
            $table->string('seller_id');
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
        Schema::dropIfExists('cars');
    }
}
