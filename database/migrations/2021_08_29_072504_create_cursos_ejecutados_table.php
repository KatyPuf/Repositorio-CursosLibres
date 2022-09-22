<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosEjecutadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_ejecutados', function (Blueprint $table) {
            $table->bigIncrements('id');
           // $table->bigInteger("curso_id")->unsigned();
            $table->bigInteger("Trimestre")->unsigned();
            $table->bigInteger("Anyo")->unsigned();
            $table->date("FechaInicio");
            $table->date("FechaFin");
            $table->time("HorarioInicio");
            $table->time("HorarioFin");
            $table->foreignId("curso_id")->references("id")->on("cursos")
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos_ejecutados');
    }
}
