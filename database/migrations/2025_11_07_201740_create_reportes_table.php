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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_rep')->nullable();
            $table->date('Fecha_reporte')->nullable;
            $table->text('Descripcion')->nullable();
            $table->string('Email');

            
            
            $table->unsignedBigInteger('administrador_id')->nullable();

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
        Schema::dropIfExists('reportes');
    }
};
