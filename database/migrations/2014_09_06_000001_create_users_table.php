<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('tipo', ['admin', 'user', 'veterinaria', 'fundacion'])->default('user');
            $table->enum('estado', ['activo', 'inactivo', 'suspendido', 'pendiente'])->default('activo'); // AGREGADO
            $table->date('fecha_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('avatar')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Auditoría (estos SÍ pueden ir aquí porque usuarios ya existe)
            $table->foreignId('creado_por')->nullable()->constrained('users');
            $table->foreignId('actualizado_por')->nullable()->constrained('users');
            $table->softDeletes();

            // ÍNDICES CORREGIDOS - SOLO columnas que existen
            $table->index('email');
            $table->index('tipo');
            $table->index('estado'); // AHORA SÍ existe
            $table->index('created_at'); // en lugar de 'fecha_ingreso'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
