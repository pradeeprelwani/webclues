<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('color_id');
            $table->string('date', 2);
            $table->string('month', 2);
            $table->string('year', 4);
            $table->enum('fuel_type', ['patrol', 'diesel', 'cng']);
            $table->text('detail')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->string('location')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->timestamps();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('=cars');
    }

}
