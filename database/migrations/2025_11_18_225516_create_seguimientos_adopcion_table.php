<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seguimientos_adopcion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adopcion_id')->constrained('adopciones');
            $table->date('fecha_seguimiento');
            $table->text('observaciones');
            $table->enum('estado_mascota', ['excelente', 'bueno', 'regular', 'preocupante']);
            $table->string('foto_url')->nullable();
            $table->foreignId('realizado_por')->constrained('usuarios');
            $table->timestamps();

            // Índices
            $table->index('fecha_seguimiento');
            $table->index('adopcion_id');
            $table->index('estado_mascota');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguimientos_adopcion');  // ✓ CORREGIDO
    }
};
