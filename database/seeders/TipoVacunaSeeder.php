<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVacunaSeeder extends Seeder
{
    public function run(): void
    {
        $vacunas = [
            // Vacunas para perros
            ['nombre_vacuna' => 'Polivalente (Múltiple)', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Rabia', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Parvovirus', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Moquillo', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Hepatitis', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Leptospirosis', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Tos de las perreras', 'frecuencia_dias' => 180, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Coronavirus canino', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Parainfluenza', 'frecuencia_dias' => 365, 'especie' => 'perro'],
            ['nombre_vacuna' => 'Bordetella', 'frecuencia_dias' => 180, 'especie' => 'perro'],

            // Vacunas para gatos
            ['nombre_vacuna' => 'Triple Felina', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Rabia felina', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Leucemia felina', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Panleucopenia', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Calicivirus', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Rinotraqueítis', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Clamidiosis', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Peritonitis infecciosa', 'frecuencia_dias' => 365, 'especie' => 'gato'],
            ['nombre_vacuna' => 'Inmunodeficiencia felina', 'frecuencia_dias' => 365, 'especie' => 'gato'],

            // Vacunas para otras mascotas
            ['nombre_vacuna' => 'Mixomatosis (Conejos)', 'frecuencia_dias' => 180, 'especie' => 'conejo'],
            ['nombre_vacuna' => 'Enfermedad hemorrágica (Conejos)', 'frecuencia_dias' => 180, 'especie' => 'conejo'],
            ['nombre_vacuna' => 'Influenza equina', 'frecuencia_dias' => 180, 'especie' => 'caballo'],
            ['nombre_vacuna' => 'Tétanos equino', 'frecuencia_dias' => 365, 'especie' => 'caballo'],
            ['nombre_vacuna' => 'Encefalomielitis equina', 'frecuencia_dias' => 365, 'especie' => 'caballo'],
            ['nombre_vacuna' => 'Newcastle (Aves)', 'frecuencia_dias' => 180, 'especie' => 'ave'],
        ];

        foreach ($vacunas as $vacuna) {
            DB::table('tipos_vacunas')->insert([
                'nombre_vacuna' => $vacuna['nombre_vacuna'],
                'frecuencia_dias' => $vacuna['frecuencia_dias'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
