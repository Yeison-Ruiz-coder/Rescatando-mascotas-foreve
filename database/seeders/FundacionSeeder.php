<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundacionSeeder extends Seeder
{
    public function run(): void
    {
        // Primero verificar si la tabla existe y tiene datos
        if (!\Illuminate\Support\Facades\Schema::hasTable('fundaciones')) {
            $this->command->error('❌ La tabla fundaciones no existe!');
            return;
        }

        // Limpiar tabla primero (opcional)
        DB::table('fundaciones')->delete();

        $fundaciones = [
            [
                'Nombre_1' => 'Fundación Patitas Felices',
                'Direccion' => 'Calle 123 #45-67, Bogotá',
                'Telefono' => '6011234567',
                'Email' => 'info@patitasfelices.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Refugio Animal Amor',
                'Direccion' => 'Avenida Principal #89-10, Medellín',
                'Telefono' => '6049876543',
                'Email' => 'contacto@refugioamor.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Hogar Temporal Mascotas',
                'Direccion' => 'Carrera 56 #12-34, Cali',
                'Telefono' => '6025551234',
                'Email' => 'hogar@mascotastemporal.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Rescate Animal Colombia',
                'Direccion' => 'Diagonal 78 #23-45, Barranquilla',
                'Telefono' => '6054447890',
                'Email' => 'rescate@animalcolombia.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Amigos de los Animales',
                'Direccion' => 'Transversal 34 #67-89, Cartagena',
                'Telefono' => '6053334567',
                'Email' => 'amigos@animales.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Fundación Salvando Vidas',
                'Direccion' => 'Calle 90 #11-22, Bucaramanga',
                'Telefono' => '6072223456',
                'Email' => 'salvando@vidas.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Protectora Animal Bogotá',
                'Direccion' => 'Avenida 68 #45-23, Bogotá',
                'Telefono' => '6017778888',
                'Email' => 'protectora@animalbogota.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        try {
            // Insertar usando DB facade
            DB::table('fundaciones')->insert($fundaciones);
            $this->command->info('7 fundaciones creadas exitosamente!');
            
            // Verificar
            $count = DB::table('fundaciones')->count();
            $this->command->info("Total de fundaciones en BD: {$count}");
            
        } catch (\Exception $e) {
            $this->command->error('Error al crear fundaciones: ' . $e->getMessage());
            
            // Mostrar información de debug
            $this->command->info('Información para debug:');
            $this->command->info('Tabla existe: ' . (\Illuminate\Support\Facades\Schema::hasTable('fundaciones') ? 'Sí' : 'No'));
            
            if (\Illuminate\Support\Facades\Schema::hasTable('fundaciones')) {
                $columns = \Illuminate\Support\Facades\Schema::getColumnListing('fundaciones');
                $this->command->info('Columnas de la tabla: ' . implode(', ', $columns));
            }
        }
    }
}