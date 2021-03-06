<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateurRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateur_role', function (Blueprint $table) {
            create_fk($table, "utilisateur");
            create_fk($table, "role");

            $table->primary([
                'id_utilisateur', 
                'id_role'
            ], 'utilisateur_role_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateur_role');
    }
}
