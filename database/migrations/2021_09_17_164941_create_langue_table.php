<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLangueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('langue', function (Blueprint $table) {
            $table->integer('id_langue')->autoIncrement();
            $table->string('nom');
            $table->string('niveau')->nullable();

            //create_fk($table, "utilisateur");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('langue');
    }
}
