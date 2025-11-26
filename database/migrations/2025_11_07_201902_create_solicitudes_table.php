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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Para Adoptar','Para Rescatar','Para Apadrinar','Para Donar']);
            $table->text('contenido'); // Cambiado a minúscula
            $table->timestamp('fecha_solicitud'); // Cambiado a minúscula
            $table->enum('estado', ['En Revisión', 'Aprobada', 'Rechazada'])->default('En Revisión'); // NUEVO
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('mascota_id')->nullable(); // NUEVO

            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('set null');
                  
            $table->foreign('mascota_id') // NUEVO
                  ->references('id')
                  ->on('mascotas')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};