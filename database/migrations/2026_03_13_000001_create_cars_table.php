<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function ($table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->decimal('price', 10, 2);
            $table->string('status');
            $table->string('image');
            $table->text('description');
            $table->integer('kilometers');
            $table->string('color');
            $table->string('fuel_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}