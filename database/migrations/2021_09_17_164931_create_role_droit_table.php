<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleDroitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_droit', function (Blueprint $table) {
            create_fk($table, "droit");
            create_fk($table, "role");

            $table->primary([
                'id_droit', 
                'id_role'
            ], 'role_droit_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_droit');
    }
}
