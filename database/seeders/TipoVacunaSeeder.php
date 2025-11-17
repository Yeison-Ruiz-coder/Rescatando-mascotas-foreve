<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoVacuna;

class TipoVacunaSeeder extends Seeder
{
    public function run(): void
    {
        $vacunas = [
            ['nombre_vacuna' => 'Rabia', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Moquillo', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Parvovirus', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Hepatitis', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Leptospirosis', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Parainfluenza', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Bordetella', 'frecuencia_dias' => 180],
            ['nombre_vacuna' => 'Triple Felina', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Leucemia Felina', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Panleucopenia', 'frecuencia_dias' => 365],
        ];

        foreach ($vacunas as $vacuna) {
            TipoVacuna::create($vacuna);
        }
    }
}