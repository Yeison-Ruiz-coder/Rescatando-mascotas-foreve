<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        if (!Schema::hasColumn('mascotas', 'galeria_fotos')) {
            Schema::table('mascotas', function (Blueprint $table) {
                $table->json('galeria_fotos')->nullable()->after('Foto');
            });
        }
    }

    public function down(): void
    {
        
        if (Schema::hasColumn('mascotas', 'galeria_fotos')) {
            Schema::table('mascotas', function (Blueprint $table) {
                $table->dropColumn('galeria_fotos');
            });
        }
    }
};