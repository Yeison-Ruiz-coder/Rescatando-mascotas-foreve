<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Raza;

class RazaSeeder extends Seeder
{
    public function run(): void
    {
        $razas = [
            // Perros
            ['nombre_raza' => 'Otro', 'especie' => 'Otro'],
            ['nombre_raza' => 'Labrador Retriever', 'especie' => 'Perro'],
            ['nombre_raza' => 'Pastor Alemán', 'especie' => 'Perro'],
            ['nombre_raza' => 'Bulldog Francés', 'especie' => 'Perro'],
            ['nombre_raza' => 'Golden Retriever', 'especie' => 'Perro'],
            ['nombre_raza' => 'Chihuahua', 'especie' => 'Perro'],
            ['nombre_raza' => 'Poodle', 'especie' => 'Perro'],
            ['nombre_raza' => 'Mestizo', 'especie' => 'Perro'],
            ['nombre_raza' => 'Husky Siberiano', 'especie' => 'Perro'],
            ['nombre_raza' => 'Boxer', 'especie' => 'Perro'],
            ['nombre_raza' => 'Dálmata', 'especie' => 'Perro'],
            
            // Gatos
            ['nombre_raza' => 'Siamés', 'especie' => 'Gato'],
            ['nombre_raza' => 'Persa', 'especie' => 'Gato'],
            ['nombre_raza' => 'Maine Coon', 'especie' => 'Gato'],
            ['nombre_raza' => 'Bengalí', 'especie' => 'Gato'],
            ['nombre_raza' => 'Mestizo', 'especie' => 'Gato'],
            ['nombre_raza' => 'Angora', 'especie' => 'Gato'],
            ['nombre_raza' => 'Sphynx', 'especie' => 'Gato'],
            
            // Conejos
            ['nombre_raza' => 'Holandés', 'especie' => 'Conejo'],
            ['nombre_raza' => 'Angora', 'especie' => 'Conejo'],
            ['nombre_raza' => 'Mini Rex', 'especie' => 'Conejo'],
        ];

        foreach ($razas as $raza) {
            Raza::create($raza);
        }
    }
}