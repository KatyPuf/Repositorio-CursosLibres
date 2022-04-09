<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModalidadToCursosEjecutados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursos_ejecutados', function (Blueprint $table) {
            //
            $table->string("modalidad")->after("Anyo");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cursos_ejecutados', function (Blueprint $table) {
            //
            $table->dropColumn('modalidad');
        });
    }
}
