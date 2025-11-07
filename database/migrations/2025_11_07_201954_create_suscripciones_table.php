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
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->id();
            $table->enum ('tipo', ['Premiun','Free','Pago_mensual','Pago_semanal']);
            $table->text('Contenido');
            $table->timestamp('Fecha_suscripcion');
            

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
        Schema::dropIfExists('suscripciones');
    }
};
