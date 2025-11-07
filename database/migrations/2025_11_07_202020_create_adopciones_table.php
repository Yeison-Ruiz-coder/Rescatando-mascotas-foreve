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
        Schema::create('adopciones', function (Blueprint $table) {
            $table->id();
            $table->string('Lugar_adopcion');
            $table->date('Fecha_adopcion');
            $table->enum ('estado', ['Aprobado','En proceso','Rechazado']);
            

            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('mascota_id')->nullable();

            $table->foreign('usuario_id')
            ->references('id')
            ->on('usuarios')
            ->onDelete('set null');

            $table->foreign('mascota_id')
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
        Schema::dropIfExists('adopciones');
    }
};
