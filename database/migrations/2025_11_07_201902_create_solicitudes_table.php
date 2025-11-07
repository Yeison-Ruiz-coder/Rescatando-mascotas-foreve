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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->enum ('tipo', ['Para Adoptar','Para Rescatar','Para Apadrinar','Para Donar']);
            $table->text('Contenido');
            $table->timestamp('Fecha_solicitud');
            

            $table->unsignedBigInteger('usuario_id')->nullable();

            $table->foreign('usuario_id')
            ->references('id')
            ->on('usuarios')
            ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
