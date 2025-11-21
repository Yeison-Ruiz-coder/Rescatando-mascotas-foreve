<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_vacunas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_vacuna')->unique();
            $table->integer('frecuencia_dias')->nullable(); // Ej: 365 días para anuales
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_vacunas');
    }
};