<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOutput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_output', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id_output');
            $table->float('quantity');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id_output')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_output');
    }
}
