<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actividad_aprendizajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposito_aprendizaje_id')->constrained('proposito_aprendizajes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('desempeño_id')->constrained('desempeños')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('criterio_evaluacion_id')->constrained('criterio_evaluacions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('titulo');
            $table->integer('orden');
            $table->string('enfoque_transversal');
            $table->text('actitud_observable');
            $table->string('competencia_transversal');
            $table->text('desempeños');
            $table->text('que_se_debe_hacer');
            $table->text('recursos_materiales');
            $table->integer('inicio_duracion');
            $table->text('inicio_actividad');
            $table->integer('desarrollo_duracion');
            $table->text('desarrollo_actividad');
            $table->integer('cierre_duracion');
            $table->text('cierre_actividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividad_aprendizajes');
    }
};
