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
            $table->foreignId('area_plantilla_id')->constrained('area_plantillas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('orden');
            $table->string('titulo');
            $table->char('genero', 1)->default('M');
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
