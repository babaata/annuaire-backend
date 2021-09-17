<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referent', function (Blueprint $table) {
            $table->integer('id_referent')->autoIncrement();
            $table->string("nom");
            $table->string("prenom");
            $table->string("poste");
            $table->string("email");
            $table->string("telephone")->nullable();

            create_fk($table, "experience_professionnelle");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referent');
    }
}
