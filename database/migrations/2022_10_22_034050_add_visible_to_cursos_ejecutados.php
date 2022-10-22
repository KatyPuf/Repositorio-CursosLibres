<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisibleToCursosEjecutados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursos_ejecutados', function (Blueprint $table) {
            $table->boolean("visible")->default(true)->after("curso_id");
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
            $table->dropColumn('visible');
        });
    }
}
