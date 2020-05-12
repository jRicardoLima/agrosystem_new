<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumUnityOnTableProductsOutput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_output', function (Blueprint $table) {
            $table->unsignedBigInteger('unity_id')->after('quantity');

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
        Schema::table('products_output', function (Blueprint $table) {
            $table->dropForeign('unity_id');
            $table->dropColumn('unity_id');
        });
    }
}
