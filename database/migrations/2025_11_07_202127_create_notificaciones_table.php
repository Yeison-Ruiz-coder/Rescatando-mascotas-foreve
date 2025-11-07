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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->text('Contenido');
            $table->timestamp('Fecha_envio');
            
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('administrador_id')->nullable();

            $table->foreign('usuario_id')
            ->references('id')
            ->on('usuarios')
            ->onDelete('set null');

            $table->foreign('administrador_id')
            ->references('id')
            ->on('administradores')
            ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
