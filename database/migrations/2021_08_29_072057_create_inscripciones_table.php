<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigInteger("estudiante_id")->unsigned();
            //$table->bigInteger("planificacione_id")->unsigned();
            $table->bigInteger("Trimestre")->unsigned();
            $table->bigInteger("Anyo")->unsigned();
            $table->timestamps();
            $table->foreignId("estudiante_id")->references("id")->on("estudiantes")->onDelete("cascade")
            ->onUpdate("cascade");
            $table->foreignId("planificacione_id")->references("id")->on("planificaciones")->onDelete("cascade")
            ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
}
