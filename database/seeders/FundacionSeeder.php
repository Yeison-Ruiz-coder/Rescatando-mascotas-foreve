<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fundacion;

class FundacionSeeder extends Seeder
{
    public function run(): void
    {
        $fundaciones = [
            [
                'Nombre_1' => 'Patitas Felices',
                'Direccion' => 'Calle 123 #45-67, Bogotá',
                'Telefono' => '3001234567',
                'Email' => 'contacto@patitasfelices.org',
                'registro_sanitario' => 'NIT-901234567-8',
                'capacidad_maxima' => 150,
                'necesidades_actuales' => json_encode(['alimento', 'medicinas', 'voluntarios']),
                'horario_atencion' => 'Lunes a Viernes 9am-5pm, Sábados 9am-2pm',
                'recibe_voluntarios' => true
            ],
            [
                'Nombre_1' => 'Huella Animal',
                'Direccion' => 'Carrera 50 #20-30, Medellín',
                'Telefono' => '3109876543',
                'Email' => 'info@huellaanimal.org',
                'registro_sanitario' => 'NIT-902345678-9',
                'capacidad_maxima' => 200,
                'necesidades_actuales' => json_encode(['alimento', 'donaciones económicas']),
                'horario_atencion' => 'Lunes a Sábado 8am-6pm',
                'recibe_voluntarios' => true
            ],
            [
                'Nombre_1' => 'Amigos de 4 Patas',
                'Direccion' => 'Avenida Siempre Viva #742, Cali',
                'Telefono' => '3205551234',
                'Email' => 'adopciones@amigos4patas.org',
                'registro_sanitario' => 'NIT-903456789-0',
                'capacidad_maxima' => 80,
                'necesidades_actuales' => json_encode(['mantas', 'medicinas', 'juguetes']),
                'horario_atencion' => 'Martes a Domingo 10am-4pm',
                'recibe_voluntarios' => true
            ],
            [
                'Nombre_1' => 'Unidos por las Patas',
                'Direccion' => 'Calle 78 #12-34, Barranquilla',
                'Telefono' => '3012345678',
                'Email' => 'contacto@unidospatas.org',
                'registro_sanitario' => 'NIT-904567890-1',
                'capacidad_maxima' => 120,
                'necesidades_actuales' => json_encode(['alimento', 'voluntarios veterinarios']),
                'horario_atencion' => 'Lunes a Viernes 9am-7pm',
                'recibe_voluntarios' => true
            ],
            [
                'Nombre_1' => 'El Refugio',
                'Direccion' => 'Carrera 23 #45-67, Bucaramanga',
                'Telefono' => '3154321098',
                'Email' => 'info@elrefugio.org',
                'registro_sanitario' => 'NIT-905678901-2',
                'capacidad_maxima' => 60,
                'necesidades_actuales' => json_encode(['mantas', 'alimento', 'medicinas']),
                'horario_atencion' => 'Lunes a Sábado 8am-5pm',
                'recibe_voluntarios' => false
            ],
            [
                'Nombre_1' => 'Patitas Callejeras',
                'Direccion' => 'Calle 45 #67-89, Cartagena',
                'Telefono' => '3178901234',
                'Email' => 'ayuda@patitascallejeras.org',
                'registro_sanitario' => 'NIT-906789012-3',
                'capacidad_maxima' => 90,
                'necesidades_actuales' => json_encode(['voluntarios', 'medicinas', 'alimento']),
                'horario_atencion' => 'Lunes a Domingo 9am-6pm',
                'recibe_voluntarios' => true
            ],
            [
                'Nombre_1' => 'Salvando Vidas Animales',
                'Direccion' => 'Avenida Las Américas #12-34, Pereira',
                'Telefono' => '3187654321',
                'Email' => 'contacto@salvandovidas.org',
                'registro_sanitario' => 'NIT-907890123-4',
                'capacidad_maxima' => 110,
                'necesidades_actuales' => json_encode(['alimento', 'donaciones']),
                'horario_atencion' => 'Miércoles a Domingo 10am-4pm',
                'recibe_voluntarios' => true
            ],
            [
                'Nombre_1' => 'Un Hogar para Todos',
                'Direccion' => 'Carrera 15 #78-90, Cúcuta',
                'Telefono' => '3198765432',
                'Email' => 'adopta@unhogarparatodos.org',
                'registro_sanitario' => 'NIT-908901234-5',
                'capacidad_maxima' => 70,
                'necesidades_actuales' => json_encode(['medicinas', 'mantas', 'alimento']),
                'horario_atencion' => 'Lunes a Viernes 8am-3pm',
                'recibe_voluntarios' => false
            ],
            [
                'Nombre_1' => 'Ángeles de 4 Patas',
                'Direccion' => 'Calle 90 #23-45, Santa Marta',
                'Telefono' => '3209876543',
                'Email' => 'info@angeles4patas.org',
                'registro_sanitario' => 'NIT-909012345-6',
                'capacidad_maxima' => 85,
                'necesidades_actuales' => json_encode(['voluntarios', 'alimento', 'juguetes']),
                'horario_atencion' => 'Martes a Sábado 9am-5pm',
                'recibe_voluntarios' => true
            ],
            [
                'Nombre_1' => 'Corazón Animal',
                'Direccion' => 'Carrera 34 #56-78, Manizales',
                'Telefono' => '3214567890',
                'Email' => 'contacto@corazonanimal.org',
                'registro_sanitario' => 'NIT-900123456-7',
                'capacidad_maxima' => 95,
                'necesidades_actuales' => json_encode(['medicinas', 'alimento']),
                'horario_atencion' => 'Lunes a Viernes 9am-6pm, Sábados 9am-1pm',
                'recibe_voluntarios' => true
            ],
        ];

        foreach ($fundaciones as $fundacion) {
            Fundacion::create($fundacion);
        }
    }
}
