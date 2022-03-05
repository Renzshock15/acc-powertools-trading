<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacted_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('transaction_id');
            $table->string('serial')->nullable();;
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('note')->nullable();
            $table->tinyInteger('is_changed')->default(1);
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
        Schema::dropIfExists('transacted_items');
    }
}
