<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceProfessionnelleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_professionnelle', function (Blueprint $table) {
            $table->integer('id_experience_professionnelle')->autoIncrement();
            $table->string("entreprise");
            $table->string("intitule_poste");
            $table->date("date_debut");
            $table->date("date_fin");
            $table->text("description");

            create_fk($table, "profil");
            create_fk($table, "type_contrat");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience_professionnelle');
    }
}
