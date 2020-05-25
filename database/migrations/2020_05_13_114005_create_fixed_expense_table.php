<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_fixed_product');
            $table->unsignedBigInteger('companies_id');
            $table->string('type');
            $table->decimal('value');
            $table->date('due_date');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('fixed_expenses');
    }
}
