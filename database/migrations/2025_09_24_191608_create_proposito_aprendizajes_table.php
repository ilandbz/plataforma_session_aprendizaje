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
        Schema::create('proposito_aprendizajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_unidad_id')->constrained('plantilla_unidads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade')->onUpdate('cascade');
            $table->text('competencia');
            $table->text('capacidades');
            $table->text('estandares');
            $table->text('desempeños');
            $table->text('criterios_evaluacion');
            $table->text('actividad');
            $table->text('evidencia');
            $table->text('instrumento_evaluacion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposito_aprendizajes');
    }
};
