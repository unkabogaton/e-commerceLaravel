<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_products', function (Blueprint $table) {
            $table->primary(['merienda_id', 'order_id']);
            $table->unsignedBigInteger('merienda_id')->references('id')->on('meriendas')->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('quantity')->legth(10);
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
        Schema::dropIfExists('ordered_products');
    }
}
