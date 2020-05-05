<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsTelphoneCelphoneEmailOnTableEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('telphone')->nullable()->after('neighborhood');
            $table->string('celphone')->after('telphone');
            $table->string('email')->nullable()->after('celphone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('telphone');
            $table->dropColumn('celphone');
            $table->dropColumn('email');

        });
    }
}
