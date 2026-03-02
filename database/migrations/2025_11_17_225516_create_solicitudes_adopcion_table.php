<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Versión mejorada de solicitudes_adopcion
    public function up()
    {
        Schema::create('solicitudes_adopcion', function (Blueprint $table) {
            $table->id();

            // Datos del solicitante
            $table->string('nombre_solicitante');
            $table->string('apellido_solicitante');
            $table->string('email');
            $table->string('telefono');
            $table->text('direccion');
            $table->string('experiencia_mascotas');
            $table->string('tipo_vivienda');
            $table->text('motivo_adopcion');

            $table->boolean('compromiso_cuidado')->default(false);
            $table->boolean('compromiso_esterilizacion')->default(false);
            $table->boolean('compromiso_seguimiento')->default(false);

            $table->string('estado')->default('Pendiente');
            $table->text('razon_rechazo')->nullable();
            $table->text('notas_administrador')->nullable();

            // 👇 CORRECCIÓN 1: Apunta a users, no a administradores
            $table->foreignId('revisado_por')  // Cambié el nombre
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            // 👇 CORRECCIÓN 2: Agrega user_id por si está registrado
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->foreignId('mascota_id')
                ->constrained('mascotas')
                ->onDelete('cascade');

            $table->timestamps();

            $table->index('estado');
            $table->index('email');
            $table->index('created_at');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_adopcion');
    }
};
