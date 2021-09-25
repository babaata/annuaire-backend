<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateurLangueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateur_langue', function (Blueprint $table) {
            
            $table->string('niveau')->nullable();

            create_fk($table, "utilisateur");
            create_fk($table, "langue");

            $table->primary(['id_utilisateur', 'id_langue']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateur_langue');
    }
}
