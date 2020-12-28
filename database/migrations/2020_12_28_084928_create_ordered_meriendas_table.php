<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedMeriendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_meriendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merienda_id')->references('id')->on('meriendas')->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('quantity');
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
        Schema::dropIfExists('ordered_meriendas');
    }
}
