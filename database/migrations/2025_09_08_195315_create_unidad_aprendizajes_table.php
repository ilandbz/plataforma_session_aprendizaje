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
        Schema::create('unidad_aprendizajes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_unidad');
            $table->string('nombre_unidad');
            $table->foreignId('tipo_id')->constrained('tipo_unidad_aprendizajes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('institucion_educativa_id')->constrained('institucion_educativas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('director');
            $table->string('sub_director');
            $table->text('descripcion_unidad')->nullable();
            $table->string('profesor');
            $table->string('grado');
            $table->string('seccion');
            $table->enum('region', ['Costa', 'Sierra', 'Amazonia']);
            $table->date('fecha_inicio');
            $table->text('situacion_significativa')->nullable();
            $table->text('productos')->nullable();
            $table->date('fecha_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad_aprendizajes');
    }
};
