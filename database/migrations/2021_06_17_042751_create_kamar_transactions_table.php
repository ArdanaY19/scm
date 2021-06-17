<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kamar_id');
            $table->string('user_id');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('harga');   
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
        Schema::dropIfExists('kamar_transactions');
    }
}
