<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesAdopcionTable extends Migration
{
    public function up()
    {
        Schema::create('solicitudes_adopcion', function (Blueprint $table) {
            $table->id();



            // Datos del solicitante (NO requiere usuario existente)
            $table->string('nombre_solicitante');
            $table->string('apellido_solicitante');
            $table->string('email');
            $table->string('telefono');
            $table->text('direccion');
            $table->string('experiencia_mascotas');
            $table->string('tipo_vivienda');
            $table->text('motivo_adopcion');

            $table->boolean('compromiso_cuidado')->default(false);
            $table->boolean('compromiso_esterilizacion')->default(false);
            $table->boolean('compromiso_seguimiento')->default(false);


            $table->string('estado')->default('Pendiente'); // Pendiente, Aprobada, Rechazada, En revisión


            $table->text('razon_rechazo')->nullable();
            $table->text('notas_administrador')->nullable();


            $table->foreignId('administrador_id')
                ->nullable()
                ->constrained('administradores')
                ->onDelete('set null');


            $table->foreignId('mascota_id')
                ->constrained('mascotas')
                ->onDelete('cascade');

            $table->timestamps();

            
            $table->index('estado');
            $table->index('email');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes_adopcion');
    }
}
