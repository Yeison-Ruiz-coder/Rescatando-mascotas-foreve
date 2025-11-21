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
            $table->unsignedBigInteger('adopcion_id');
            $table->date('fecha_entrevista');
            $table->text('notas');
            $table->enum('resultado', ['Aprobado', 'Rechazado', 'Pendiente']);

            $table->unsignedBigInteger('administrador_id');

            $table->foreign('adopcion_id')
            ->references('id')
            ->on('adopciones')
            ->onDelete('cascade');
            
            $table->foreign('administrador_id')
            ->references('id')
            ->on('administradores');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};
