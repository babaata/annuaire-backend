<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->integer('id_utilisateur')->autoIncrement();
            $table->string('nom_utilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_de_naissance')->nullable();
            $table->string('sexe')->nullable();
            $table->string('email');//;->unique();
            $table->string('telephone')->nullable();
            $table->dateTime('date_de_creation')->nullable();
            $table->dateTime('date_de_modification')->nullable();
            $table->boolean('statut')->nullable();
            $table->dateTime('date_de_desactivation')->nullable();
            $table->string('url_photo')->nullable();
            $table->string('password');
            $table->string('api_token', 80)
                        ->unique()
                        ->nullable()
                        ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateur');
    }
}
