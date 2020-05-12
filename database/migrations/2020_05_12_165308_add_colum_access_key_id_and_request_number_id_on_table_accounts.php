<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumAccessKeyIdAndRequestNumberIdOnTableAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('access_key_id')->after('status');
            $table->unsignedBigInteger('request_number_id')->after('access_key_id')->nullable();

            $table->foreign('access_key_id')->references('id')->on('invoices');
            $table->foreign('request_number_id')->references('id')->on('purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropForeign('access_key_id');
            $table->dropForeign('request_number_id');
            $table->dropColumn('access_number_id');
            $table->dropColumn('request_number_id');
        });
    }
}
