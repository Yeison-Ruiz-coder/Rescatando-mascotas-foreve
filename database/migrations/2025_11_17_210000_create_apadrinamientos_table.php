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
        Schema::create('apadrinamientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('mascota_id')->constrained('mascotas');
            $table->decimal('monto_mensual', 10, 2);
            $table->enum('frecuencia', ['unica', 'mensual', 'trimestral', 'anual'])->default('mensual');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['activo', 'pausado', 'cancelado', 'finalizado'])->default('activo');
            $table->text('mensaje_apoyo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apadrinamientos');
    }
};
