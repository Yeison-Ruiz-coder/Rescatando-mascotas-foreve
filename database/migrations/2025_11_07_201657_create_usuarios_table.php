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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_1');
            $table->string('Nombre_2')->nullable();
            $table->string('Apellido_1');
            $table->string('Apellido_2')->nullable();
            $table->date('Fecha_nacimiento');
            $table->string('Direccion');
            $table->string('Telefono');
            $table->string('Email')->unique();
            $table->string('Password_user');
            $table->enum ('tipo', ['Administrador','Rescatista','Voluntario', 'Cliente']);

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
        Schema::dropIfExists('usuarios');
    }
};
