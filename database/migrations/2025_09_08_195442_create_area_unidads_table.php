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
        Schema::create('area_unidads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('unidad_aprendizaje_id')->constrained('unidad_aprendizajes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_unidads');
    }
};
