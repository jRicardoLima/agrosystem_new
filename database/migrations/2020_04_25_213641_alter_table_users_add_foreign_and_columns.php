<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersAddForeignAndColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('occupation_id')->after('password');
            $table->unsignedBigInteger('unity_id')->after('occupation_id');

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['occupation_id']);
            $table->dropForeign(['unity_id']);
            $table->dropForeign('');
            $table->dropColumn('occupation_id');
            $table->dropColumn('unity_id');
        });
    }
}
