<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rescates', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_rescate');
            $table->string('lugar_rescate');
            $table->text('descripcion_rescate');
            $table->enum('estado', ['en_proceso', 'completado', 'seguimiento'])->default('en_proceso');

            $table->foreignId('mascota_id')->nullable()->constrained('mascotas')->onDelete('set null');
            $table->foreignId('reporte_id')->nullable()->constrained('reportes')->onDelete('set null'); // Si vino de un reporte
            $table->foreignId('usuario_reporto_id')->nullable()->constrained('users')->onDelete('set null'); // Quien lo reportó
            $table->foreignId('veterinaria_id')->nullable()->constrained('veterinarias')->onDelete('set null');
            $table->foreignId('fundacion_id')->nullable()->constrained('fundaciones')->onDelete('set null');
            $table->foreignId('administrador_gestion_id')->nullable()->constrained('users')->onDelete('set null'); // Quien lo gestiona

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rescates');
    }
};
