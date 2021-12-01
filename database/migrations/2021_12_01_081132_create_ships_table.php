<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->string('sn')->nullable();
            $table->string('imei')->nullable();
            $table->string('type', 32)->nullable();
            $table->string('name', 32)->nullable();
            $table->string('customer_id')->nullable();
            $table->text('deskripsi', 32)->nullable();
            $table->dateTime('airtime_start')->nullable();
            $table->dateTime('airtime_end')->nullable();
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
        Schema::dropIfExists('ships');
    }
}