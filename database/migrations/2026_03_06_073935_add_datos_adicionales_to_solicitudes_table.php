<?php
// database/migrations/[fecha]_add_datos_adicionales_to_solicitudes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->json('datos_adicionales')->nullable()->after('telefono_solicitante');
            // También podemos agregar un índice para búsquedas en JSON si es necesario
            // $table->index('datos_adicionales->tipo_vivienda'); // Para MySQL 5.7+
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropColumn('datos_adicionales');
        });
    }
};
