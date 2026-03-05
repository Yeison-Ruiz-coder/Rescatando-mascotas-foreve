<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Raza;

class RazaSeeder extends Seeder
{
    public function run(): void
    {
        $razas = [
            // Razas de Perros
            ['nombre_raza' => 'Labrador Retriever', 'especie' => 'Perro'],
            ['nombre_raza' => 'Pastor Alemán', 'especie' => 'Perro'],
            ['nombre_raza' => 'Golden Retriever', 'especie' => 'Perro'],
            ['nombre_raza' => 'Bulldog Francés', 'especie' => 'Perro'],
            ['nombre_raza' => 'Poodle', 'especie' => 'Perro'],
            ['nombre_raza' => 'Chihuahua', 'especie' => 'Perro'],
            ['nombre_raza' => 'Husky Siberiano', 'especie' => 'Perro'],
            ['nombre_raza' => 'Dálmata', 'especie' => 'Perro'],
            ['nombre_raza' => 'Pug', 'especie' => 'Perro'],
            ['nombre_raza' => 'Rottweiler', 'especie' => 'Perro'],

            // Razas de Gatos
            ['nombre_raza' => 'Siamés', 'especie' => 'Gato'],
            ['nombre_raza' => 'Persa', 'especie' => 'Gato'],
            ['nombre_raza' => 'Maine Coon', 'especie' => 'Gato'],
            ['nombre_raza' => 'Bengalí', 'especie' => 'Gato'],
            ['nombre_raza' => 'Sphynx', 'especie' => 'Gato'],
            ['nombre_raza' => 'Angora', 'especie' => 'Gato'],
            ['nombre_raza' => 'British Shorthair', 'especie' => 'Gato'],
            ['nombre_raza' => 'Abisinio', 'especie' => 'Gato'],
            ['nombre_raza' => 'Ragdoll', 'especie' => 'Gato'],
            ['nombre_raza' => 'Birmano', 'especie' => 'Gato'],
        ];

        foreach ($razas as $raza) {
            Raza::create($raza);
        }
    }
}
