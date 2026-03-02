<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_mascota');
            $table->string('especie')->nullable(); // Perro, Gato, etc.
            // El campo 'raza' se manejará con la tabla pivote 'mascota_raza'
            $table->integer('edad_aprox')->nullable();
            $table->enum('genero', ['Macho', 'Hembra', 'Desconocido'])->nullable();
            $table->enum('estado', ['Adoptado', 'En adopcion', 'Rescatada', 'En acogida'])->default('En adopcion');
            $table->string('lugar_rescate')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('foto_principal')->nullable(); // Ruta de la foto principal
            $table->json('galeria_fotos')->nullable();
            $table->boolean('necesita_hogar_temporal')->default(false);
            $table->boolean('apto_con_ninos')->default(true);
            $table->boolean('apto_con_otros_animales')->default(true);
            $table->text('condiciones_especiales')->nullable(); // Enfermedades crónicas, discapacidades
            // El campo 'vacunas' se manejará con la tabla pivote 'mascota_vacuna'
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_salida')->nullable();

            $table->unsignedBigInteger('fundacion_id')->nullable();
            $table->foreign('fundacion_id')
                ->references('id')
                ->on('fundaciones')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
