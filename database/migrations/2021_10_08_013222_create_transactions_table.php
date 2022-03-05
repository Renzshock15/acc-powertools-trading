<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('transaction_type_id');
            $table->date('transaction_date');
            $table->unsignedBigInteger('transaction_comment_id');
            $table->string('transaction_receipt')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('from');
            $table->string('to');
            $table->unsignedBigInteger('store_id');
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
        Schema::dropIfExists('transactions');
    }
}
