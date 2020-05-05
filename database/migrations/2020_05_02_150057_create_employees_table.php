<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',80);
            $table->string('document_primary',11)->unique();
            $table->string('document_secondary',20)->nullable();
            $table->string('document_secondary_complement',20)->nullable();
            $table->boolean('married')->default(0);
            $table->boolean('children')->default(0);
            $table->integer('number_of_children')->default(0);
            $table->date('date_birth');
            $table->string('zipcode')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('neighborhood');
            $table->date('contract_date');
            $table->date('departure_date')->nullable();
            $table->decimal('salary');
            $table->unsignedBigInteger('occupation_id');
            $table->unsignedBigInteger('unity_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('unity_id')->references('id')->on('unities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
