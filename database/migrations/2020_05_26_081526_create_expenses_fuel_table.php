<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesFuelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_fuel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_product');
            $table->text('access_key');
            $table->float('quantity');
            $table->string('type');
            $table->decimal('value');
            $table->date('due_date');
            $table->boolean('status');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('purchase_id');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('purchase_id')->references('id')->on('purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_fuel');
    }
}
