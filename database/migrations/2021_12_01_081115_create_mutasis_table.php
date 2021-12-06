<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasis', function (Blueprint $table) {
            $table->id();
            $table->integer('sn')->unique();
            $table->string('imei', 15);
            $table->unsignedInteger('mark')->default(1);
            $table->unsignedInteger('owner')->nullable();
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('warehouse_from');
            $table->unsignedInteger('warehouse_to')->nullable();
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('reason',124)->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('mutasis');
    }
}