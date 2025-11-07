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
        Schema::create('rescates', function (Blueprint $table) {
            $table->id();
            $table->date('Fecha_rescate');
            $table->string('Lugar_rescate');
            $table->text('Descripcion_rescate');
            
            
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('mascota_id')->nullable();
            $table->unsignedBigInteger('veterinaria_id')->nullable();
            $table->unsignedBigInteger('tienda_id')->nullable(); 
            $table->unsignedBigInteger('fundacion_id')->nullable();
            $table->unsignedBigInteger('administrador_id')->nullable();
            

            $table->foreign('usuario_id')
            ->references('id')
            ->on('usuarios')
            ->onDelete('set null');

            $table->foreign('mascota_id')
            ->references('id')
            ->on('mascotas')
            ->onDelete('set null');

            $table->foreign('veterinaria_id')
            ->references('id')
            ->on('veterinarias')
            ->onDelete('set null');

            $table->foreign('tienda_id')
            ->references('id')
            ->on('tiendas')
            ->onDelete('set null');

            $table->foreign('fundacion_id')
            ->references('id')
            ->on('fundaciones')
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
        Schema::dropIfExists('rescates');
    }
};
