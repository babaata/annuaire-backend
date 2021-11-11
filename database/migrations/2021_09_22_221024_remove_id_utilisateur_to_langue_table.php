<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdUtilisateurToLangueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('langue', function (Blueprint $table) {
        //     $table->dropForeign(['id_utilisateur']);
        //     $table->dropColumn(['id_utilisateur', 'niveau']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('langue', function (Blueprint $table) {
        //     $table->string('niveau')->nullable();
        //     create_fk($table, "utilisateur");
        // });
    }
}
