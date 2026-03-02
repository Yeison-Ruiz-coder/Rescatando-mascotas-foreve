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

            // Tipo y fecha
            $table->enum('tipo_seguimiento', ['virtual', 'domiciliario', 'telefonico'])->default('virtual');
            $table->date('fecha_seguimiento');
            $table->date('proximo_seguimiento')->nullable();

            // Observaciones generales
            $table->text('observaciones');
            $table->text('recomendaciones')->nullable();

            // Evaluación
            $table->enum('estado_mascota', ['excelente', 'bueno', 'regular', 'preocupante']);
            $table->enum('resultado', ['satisfactorio', 'observaciones', 'incumplimiento', 'reingreso'])->default('satisfactorio');

            // Evidencia
            $table->string('foto_url')->nullable();
            $table->json('fotos_adicionales')->nullable();
            $table->string('video_url')->nullable();
            $table->string('documento_url')->nullable(); // Acta de visita

            // Datos del hogar (para domiciliarios)
            $table->enum('condiciones_hogar', ['optimas', 'aceptables', 'mejorables', 'precarias'])->nullable();
            $table->text('observaciones_hogar')->nullable();
            $table->boolean('convive_con_otros_animales')->nullable();

            // Comportamiento
            $table->text('comportamiento_observado')->nullable();

            // Gestión
            $table->foreignId('realizado_por')->constrained('users');
            $table->string('realizado_por_nombre')->nullable(); // Por si el usuario se elimina
            $table->boolean('requiere_nuevo_seguimiento')->default(false);

            // Confirmación
            $table->boolean('firma_adoptante')->default(false);
            $table->timestamp('fecha_confirmacion')->nullable();

            $table->timestamps();

            // Índices mejorados
            $table->index('fecha_seguimiento');
            $table->index('proximo_seguimiento');
            $table->index('adopcion_id');
            $table->index('estado_mascota');
            $table->index('resultado');
            $table->index('requiere_nuevo_seguimiento');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguimientos_adopcion');
    }
};
