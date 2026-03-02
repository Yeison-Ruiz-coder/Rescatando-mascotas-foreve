<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2025_11_07_202154_create_donaciones_table.php
    public function up(): void
    {
        Schema::create('donaciones', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_donacion', 10, 2);
            $table->timestamp('fecha_donacion')->useCurrent(); // Cambiado Fecha_donacion
            $table->boolean('publica')->default(false);

            // CORREGIDO: Apunta a users
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->foreignId('fundacion_id')
                ->nullable()
                ->constrained('fundaciones')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaciones');
    }
};
