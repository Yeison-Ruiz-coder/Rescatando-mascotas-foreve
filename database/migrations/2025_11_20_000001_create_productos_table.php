<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('imagen_url')->nullable();
            $table->enum('estado', ['disponible', 'agotado', 'oculto'])->default('disponible');

            // Relación con tienda
            $table->foreignId('tienda_id')->nullable()->constrained('tiendas')->onDelete('set null');
            // Relación DIRECTA con users (fundación o veterinaria)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();

            $table->index('user_id');
            $table->index('tienda_id');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
