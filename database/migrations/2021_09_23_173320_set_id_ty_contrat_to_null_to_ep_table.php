<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetIdTyContratToNullToEpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experience_professionnelle', function (Blueprint $table) {
            //$table->dropForeign(['id_type_contrat']);
            //$table->dropColumn(['id_type_contrat']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experience_professionnelle', function (Blueprint $table) {
            //create_fk($table, "type_contrat", true);
            //$table->string('id_type_contrat');
        });
    }
}
