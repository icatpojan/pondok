<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no', 60)->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('invoice_date')->nullable();
            $table->string('type')->nullable();
            $table->text('deskripsi', 64)->nullable();
            $table->text('address', 64)->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('npwp')->nullable();
            $table->dateTime('transfer_date')->nullable();
            $table->unsignedInteger('total_harga')->nullable();
            $table->unsignedInteger('harga_akhir')->nullable();
            $table->unsignedInteger('ppn')->nullable();
            $table->string('bank')->nullable();
            $table->string('status')->nullable()->default('Not Yet Paid Off');
            $table->string('transfer_name')->nullable();
            $table->string('contact')->nullable();
            $table->string('persen')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('discount')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('ship_id')->nullable();
            $table->dateTime('airtime_start')->nullable();
            $table->dateTime('airtime_end')->nullable();
            $table->unsignedInteger('airtime_price')->nullable();
            $table->unsignedInteger('transmiter_id')->nullable();
            $table->unsignedInteger('airtime')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('mark')->default(null);
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
        Schema::dropIfExists('invoices');
    }
}
