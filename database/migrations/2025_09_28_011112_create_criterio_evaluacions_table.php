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
        Schema::create('criterio_evaluacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposito_aprendizaje_id')->constrained('proposito_aprendizajes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterio_evaluacions');
    }
};
