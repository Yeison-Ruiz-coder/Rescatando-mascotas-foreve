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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_mascota');
            $table->string('Especie')->nullable();
            $table->string('Raza');
            $table->integer('Edad_aprox')->unique();
            $table->string('Genero')->unique();
            $table->enum ('estado', ['Adoptado','En adopcion','Rescatada']);
            $table->string('Lugar_rescate')->unique();
            $table->text('Descripcion');
            $table->text('Foto');
            $table->string('vacunas')->unique();
            $table->date('Fecha_ingreso')->unique();
            $table->date('Fecha_salida')->nullable()->unique();

            $table->unsignedBigInteger('fundacion_id')->nullable();

            $table->foreign('fundacion_id')
            ->references('id')
            ->on('fundaciones')
            ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
