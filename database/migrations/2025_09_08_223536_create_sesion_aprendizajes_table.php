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
        Schema::create('sesion_aprendizajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_unidad_aprendizaje_id')->constrained('area_unidads')->onDelete('cascade')->onUpdate('cascade');
            $table->date('fecha');
            $table->string('titulo_sesion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_aprendizajes');
    }
};
