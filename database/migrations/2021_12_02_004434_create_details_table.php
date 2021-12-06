<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('sn', 60)->unique();
            $table->string('imei', 60)->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('produk_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->unsignedInteger('owner')->nullable();
            $table->integer('transaksi_id')->nullable();
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
        Schema::dropIfExists('details');
    }
}