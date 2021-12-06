<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sn')->nullable();
            $table->string('imei', 100)->nullable();
            $table->string('keterangan', 124)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->unsignedInteger('entri_user_masuk')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->dateTime('tgl_keluar')->nullable()->default(null);
            $table->unsignedInteger('entri_user_keluar')->nullable()->default(null);
            $table->unsignedInteger('product_id')->nullable();
            $table->dateTime('tgl_edit')->nullable()->default(null);
            $table->unsignedInteger('user_edit')->nullable()->default(null);
            $table->dateTime('tgl_delete')->nullable()->default(null);
            $table->unsignedInteger('user_delete')->nullable()->default(null);
            $table->tinyInteger('flag_delete')->nullable()->default(null);
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->string('mark')->default('ON');
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
        Schema::dropIfExists('products');
    }
}