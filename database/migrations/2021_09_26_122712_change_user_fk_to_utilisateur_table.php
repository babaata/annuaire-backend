<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserFkToUtilisateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            $table->dropForeign(['id_profil']);
            $table->foreign("id_profil")->references("id_profil")->on("profil")->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            create_fk($table, "profil", true);
        });
    }
}
