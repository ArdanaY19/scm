<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('user_id')->unsigned();
            $table->date('tanggal');
            $table->string('status');
            $table->integer('ongkir')->nullable();
            $table->integer('kode');
            $table->integer('jumlah_harga');
            $table->string('bukti_transfer')->nullable();
            $table->string('bukti_resi')->nullable();
            $table->timestamps();
        });

        Schema::table('k_transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('k_transactions');
    }
}
