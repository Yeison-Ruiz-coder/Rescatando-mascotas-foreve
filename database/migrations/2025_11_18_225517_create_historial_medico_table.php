<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_medico', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->foreignId('veterinaria_id')->nullable()->constrained('veterinarias');
            $table->foreignId('veterinario_id')->nullable()->constrained('usuarios');
            $table->foreignId('registrado_por')->constrained('usuarios');

            $table->date('fecha_consulta');
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->text('observaciones')->nullable();
            $table->string('documento_url')->nullable();

            $table->timestamps();

            // Índices útiles
            $table->index('fecha_consulta');
            $table->index('mascota_id');
            $table->index('veterinaria_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_medico');  // ✓ CORREGIDO
    }
};
