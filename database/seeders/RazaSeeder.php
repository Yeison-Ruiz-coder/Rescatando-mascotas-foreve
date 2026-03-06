<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Raza; // Asegúrate de tener el modelo Raza

class RazaSeeder extends Seeder
{
    public function run(): void
    {
        $razas = [
            // Razas de perros
            ['nombre_raza' => 'Labrador Retriever', 'especie' => 'perro'],
            ['nombre_raza' => 'Pastor Alemán', 'especie' => 'perro'],
            ['nombre_raza' => 'Golden Retriever', 'especie' => 'perro'],
            ['nombre_raza' => 'Bulldog Francés', 'especie' => 'perro'],
            ['nombre_raza' => 'Beagle', 'especie' => 'perro'],
            ['nombre_raza' => 'Poodle', 'especie' => 'perro'],
            ['nombre_raza' => 'Chihuahua', 'especie' => 'perro'],
            ['nombre_raza' => 'Yorkshire Terrier', 'especie' => 'perro'],
            ['nombre_raza' => 'Boxer', 'especie' => 'perro'],
            ['nombre_raza' => 'Shih Tzu', 'especie' => 'perro'],
            ['nombre_raza' => 'Rottweiler', 'especie' => 'perro'],
            ['nombre_raza' => 'Doberman', 'especie' => 'perro'],
            ['nombre_raza' => 'Husky Siberiano', 'especie' => 'perro'],
            ['nombre_raza' => 'Dálmata', 'especie' => 'perro'],
            ['nombre_raza' => 'Pug', 'especie' => 'perro'],
            ['nombre_raza' => 'Maltés', 'especie' => 'perro'],
            ['nombre_raza' => 'Pomerania', 'especie' => 'perro'],
            ['nombre_raza' => 'San Bernardo', 'especie' => 'perro'],
            ['nombre_raza' => 'Dogo Argentino', 'especie' => 'perro'],
            ['nombre_raza' => 'Pitbull', 'especie' => 'perro'],
            ['nombre_raza' => 'Mestizo', 'especie' => 'perro'],
            ['nombre_raza' => 'Criollo', 'especie' => 'perro'],
            // ... resto de razas
        ];

        foreach ($razas as $raza) {
            Raza::updateOrCreate(
                ['nombre_raza' => $raza['nombre_raza']], // Buscar por nombre_raza
                [
                    'especie' => $raza['especie'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        $this->command->info('Razas insertadas/actualizadas correctamente');
    }
}
