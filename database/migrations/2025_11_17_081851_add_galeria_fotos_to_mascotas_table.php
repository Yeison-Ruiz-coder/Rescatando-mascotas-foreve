<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGaleriaFotosToMascotasTable extends Migration
{
    public function up()
    {
        Schema::table('mascotas', function (Blueprint $table) {
            $table->json('galeria_fotos')->nullable()->after('Foto');
        });
    }

    public function down()
    {
        Schema::table('mascotas', function (Blueprint $table) {
            $table->dropColumn('galeria_fotos');
        });
    }
}