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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_evento');
            $table->string('Lugar_evento');
            $table->text('Descripcion');
            $table->date('Fecha_evento')->nullable();
            $table->string('imagen_url')->nullable();

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
        Schema::dropIfExists('eventos');
    }
};
