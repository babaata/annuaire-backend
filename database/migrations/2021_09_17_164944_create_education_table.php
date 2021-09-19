<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->integer('id_education')->autoIncrement();
            $table->string("ecole");
            $table->string("pays")->nullable();;
            $table->string("ville")->nullable();;
            $table->string("diplome");
            $table->date("date_debut");
            $table->date("date_fin");
            $table->text("description");

            create_fk($table, "profil");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
