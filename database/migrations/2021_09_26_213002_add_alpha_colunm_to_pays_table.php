<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlphaColunmToPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pays', function (Blueprint $table) {
            $table->dropColumn(['code_pays']);
            $table->string("alpha2")->nullable();
            $table->string("alpha3")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pays', function (Blueprint $table) {
            $table->string("code_pays")->nullable();
            $table->dropColumn(['alpha2', 'alpha3']);
        });
    }
}
