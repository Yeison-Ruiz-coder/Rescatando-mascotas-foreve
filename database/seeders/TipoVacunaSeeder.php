<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoVacuna;

class TipoVacunaSeeder extends Seeder
{
    public function run(): void
    {
        $vacunas = [
            // Vacunas para perros
            ['nombre_vacuna' => 'Múltiple (Perros)', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Rabia (Perros)', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Parvovirus', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Moquillo', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Hepatitis Canina', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Leptospirosis', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Tos de las perreras', 'frecuencia_dias' => 180],
            ['nombre_vacuna' => 'Coronavirus Canino', 'frecuencia_dias' => 365],

            // Vacunas para gatos
            ['nombre_vacuna' => 'Triple Felina', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Rabia (Gatos)', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Leucemia Felina', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Inmunodeficiencia Felina', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Peritonitis Infecciosa', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Clamidiosis Felina', 'frecuencia_dias' => 365],
            ['nombre_vacuna' => 'Bordetella', 'frecuencia_dias' => 180],
            ['nombre_vacuna' => 'Giardia', 'frecuencia_dias' => 365],
        ];

        foreach ($vacunas as $vacuna) {
            TipoVacuna::create($vacuna);
        }
    }
}
