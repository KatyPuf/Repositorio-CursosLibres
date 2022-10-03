<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisibleToPlanificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planificaciones', function (Blueprint $table) {
            $table->boolean("visible")->default(true)->after("linkAulaVirtuales");
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
            $table->dropColumn('visible');
        });
    }
}
