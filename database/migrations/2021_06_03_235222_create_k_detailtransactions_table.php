<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKDetailtransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_detailtransactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('katalog_id')->unsigned();
            $table->biginteger('k_transaction_id')->unsigned();
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->timestamps();
        });

        Schema::table('k_detailtransactions', function (Blueprint $table) {
            $table->foreign('katalog_id')->references('id')->on('katalogs');
            $table->foreign('k_transaction_id')->references('id')->on('k_transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('k_detailtransactions');
    }
}
