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
        Schema::create('plantilla_unidads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('grado');
            $table->integer('tiene_educacion_fisica')->default(1);
            $table->foreignId('tipo_id')->constrained('tipo_unidad_aprendizajes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nombre_unidad');
            $table->integer('numero_unidad');
            $table->integer('situacion_significativa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_unidads');
    }
};
