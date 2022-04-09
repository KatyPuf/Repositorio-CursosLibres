<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModalidadToPlanificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planificaciones', function (Blueprint $table) {
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
        Schema::table('planificaciones', function (Blueprint $table) {
            //
            $table->dropColumn('modalidad');
        });
    }
}
