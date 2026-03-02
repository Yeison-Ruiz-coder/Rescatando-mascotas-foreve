<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adopcion_id')
                ->constrained('adopciones')
                ->onDelete('cascade');

            $table->date('fecha_entrevista');
            $table->text('notas');
            $table->enum('resultado', ['Aprobado', 'Rechazado', 'Pendiente'])->default('Pendiente');

            // CORREGIDO: Apunta a users
            $table->foreignId('administrador_id')
                ->constrained('users'); // El admin que hace la entrevista

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};
