<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePlanificacionesTrimestreDatatype extends Migration
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
            DB::statement("ALTER TABLE planificaciones MODIFY Trimestre varchar(255)");
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
            DB::statement("ALTER TABLE planificaciones MODIFY Trimestre int");
        });
    }
}
