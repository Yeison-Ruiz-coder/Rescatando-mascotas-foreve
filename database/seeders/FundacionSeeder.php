<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundacionSeeder extends Seeder
{
    public function run(): void
    {
        $fundaciones = [
            [
                'Nombre_1' => 'Huellas Felices',
                'Direccion' => 'Carrera 45 #67-89, Bogotá',
                'Telefono' => '+57 601 2345678',
                'Email' => 'info@huellasfelices.org',
                'registro_sanitario' => 'FND-2023-001',
                'capacidad_maxima' => 150,
                'necesidades_actuales' => json_encode(['concentrado', 'medicamentos', 'cobijas', 'voluntarios']),
                'horario_atencion' => 'Lunes a Viernes 9am-5pm, Sábados 9am-1pm',
                'recibe_voluntarios' => true,
            ],
            [
                'Nombre_1' => 'Patitas Sin Hogar',
                'Direccion' => 'Av. Siempre Viva 742, Medellín',
                'Telefono' => '+57 604 9876543',
                'Email' => 'contacto@patitassinhogar.org',
                'registro_sanitario' => 'FND-2022-045',
                'capacidad_maxima' => 80,
                'necesidades_actuales' => json_encode(['vacunas', 'alimento para gatos', 'arenas sanitarias']),
                'horario_atencion' => 'Lunes a Domingo 10am-6pm',
                'recibe_voluntarios' => true,
            ],
            [
                'Nombre_1' => 'Fundación Animal Libre',
                'Direccion' => 'Calle 23 #45-67, Cali',
                'Telefono' => '+57 602 3456789',
                'Email' => 'adopciones@animallibre.org',
                'registro_sanitario' => 'FND-2023-089',
                'capacidad_maxima' => 200,
                'necesidades_actuales' => json_encode(['cirugías', 'jaulas', 'mantas', 'voluntarios veterinarios']),
                'horario_atencion' => 'Lunes a Sábado 8am-4pm',
                'recibe_voluntarios' => true,
            ],
            [
                'Nombre_1' => 'Rescate Canino Colombia',
                'Direccion' => 'Transversal 78 #12-34, Barranquilla',
                'Telefono' => '+57 605 1234567',
                'Email' => 'rescate@caninocolombia.org',
                'registro_sanitario' => 'FND-2021-112',
                'capacidad_maxima' => 120,
                'necesidades_actuales' => json_encode(['correas', 'collares', 'desparasitantes', 'shampoo']),
                'horario_atencion' => 'Lunes a Viernes 8am-5pm',
                'recibe_voluntarios' => false,
            ],
            [
                'Nombre_1' => 'Gatitos del Parque',
                'Direccion' => 'Carrera 19 #34-56, Bucaramanga',
                'Telefono' => '+57 607 7890123',
                'Email' => 'info@gatitosdelparque.org',
                'registro_sanitario' => 'FND-2023-156',
                'capacidad_maxima' => 60,
                'necesidades_actuales' => json_encode(['alimento para gatos', 'rascadores', 'juguetes', 'camas']),
                'horario_atencion' => 'Martes a Domingo 10am-3pm',
                'recibe_voluntarios' => true,
            ],
            [
                'Nombre_1' => 'Cuatro Patas Una Familia',
                'Direccion' => 'Calle 78 #56-34, Cartagena',
                'Telefono' => '+57 605 4567890',
                'Email' => 'adopta@cuatropatas.org',
                'registro_sanitario' => 'FND-2022-234',
                'capacidad_maxima' => 95,
                'necesidades_actuales' => json_encode(['hogares de paso', 'antibióticos', 'pipetas antipulgas']),
                'horario_atencion' => 'Lunes a Sábado 9am-5pm',
                'recibe_voluntarios' => true,
            ],
            [
                'Nombre_1' => 'Vida Animal Santander',
                'Direccion' => 'Carrera 27 #45-67, Bucaramanga',
                'Telefono' => '+57 607 2345678',
                'Email' => 'contacto@vidaanimalsantander.org',
                'registro_sanitario' => 'FND-2023-045',
                'capacidad_maxima' => 75,
                'necesidades_actuales' => json_encode(['esterilizaciones', 'concentrado', 'gasas', 'vendas']),
                'horario_atencion' => 'Lunes a Viernes 8am-4pm',
                'recibe_voluntarios' => false,
            ],
            [
                'Nombre_1' => 'Fundación Caballos de Paso',
                'Direccion' => 'Vereda El Recreo, Km 5, Pereira',
                'Telefono' => '+57 606 9876543',
                'Email' => 'info@caballosdepaso.org',
                'registro_sanitario' => 'FND-2021-067',
                'capacidad_maxima' => 40,
                'necesidades_actuales' => json_encode(['herraduras', 'forraje', 'vitaminas', 'cuidadores']),
                'horario_atencion' => 'Lunes a Domingo 7am-6pm',
                'recibe_voluntarios' => true,
            ],
        ];

        foreach ($fundaciones as $fundacion) {
            DB::table('fundaciones')->insert([
                'Nombre_1' => $fundacion['Nombre_1'],
                'Direccion' => $fundacion['Direccion'],
                'Telefono' => $fundacion['Telefono'],
                'Email' => $fundacion['Email'],
                'registro_sanitario' => $fundacion['registro_sanitario'],
                'capacidad_maxima' => $fundacion['capacidad_maxima'],
                'necesidades_actuales' => $fundacion['necesidades_actuales'],
                'horario_atencion' => $fundacion['horario_atencion'],
                'recibe_voluntarios' => $fundacion['recibe_voluntarios'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
