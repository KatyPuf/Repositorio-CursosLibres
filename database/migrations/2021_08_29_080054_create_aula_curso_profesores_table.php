<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulaCursoProfesoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula_curso_profesor', function (Blueprint $table) {
           //$table->bigInteger("profesor_id")->unsigned();
            //$table->bigInteger("cursos_ejecutado_id")->unsigned();
            //$table->bigInteger("aula_id")->unsigned();
            $table->bigIncrements('id');
            $table->foreignId("profesor_id")->references("id")->on("profesores")->onDelete("cascade")
            ->onUpdate("cascade");
            $table->foreignId("curso_ejecutado_id")->references("id")->on("cursos_ejecutados")->onDelete("cascade")
            ->onUpdate("cascade");
            $table->foreignId("aula_id")->references("id")->on("aulas")
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aula_curso_profesores');
    }
}
