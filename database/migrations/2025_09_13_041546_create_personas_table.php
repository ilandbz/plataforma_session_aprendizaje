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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->char('dni', 8)->unique();
            $table->string('ape_pat', 60);
            $table->string('ape_mat', 60);
            $table->string('primernombre', 70);
            $table->string('otrosnombres', 70);
            $table->date('fecha_nac')->default('2000-01-01');
            $table->char('ubigeo_nac',6)->nullable()->default('090101');
            $table->char('genero', 1)->default('M');
            $table->char('celular', 11)->nullable();
            $table->string('email', 70)->nullable();
            $table->char('ruc', 11)->nullable();
            $table->string('estado_civil', 35)->default('SOLTERO');
            $table->string('profesion', 90)->nullable()->default('NINGUNO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
