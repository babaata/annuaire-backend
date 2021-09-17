<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification', function (Blueprint $table) {
            $table->integer('id_certification')->autoIncrement();
            $table->string("nom");
            $table->string("organisme_delivrance");
            $table->string("level")->nullable();
            $table->date("date_certification")->nullable();
            $table->string("url")->nullable();

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
        Schema::dropIfExists('certification');
    }
}
