<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Verificar conexión a la base de datos
            DB::connection()->getPdo();

            // Obtener mascotas disponibles - USANDO LOS NOMBRES CORRECTOS DE LAS MIGRACIONES
            $mascotasRecientes = Mascota::where(function($query) {
                    $query->where('estado', 'En adopcion')
                          ->orWhere('estado', 'En adopción')
                          ->orWhere('estado', 'Disponible')
                          ->orWhere('estado', 'like', '%adopcion%');
                })
                ->with('fundacion')
                ->latest()
                ->take(3)
                ->get();

            // Si no hay mascotas, usar datos de ejemplo
            if ($mascotasRecientes->isEmpty()) {
                $mascotasRecientes = $this->getMascotasDemo();
            }

        } catch (\Exception $e) {
            // Si hay error de conexión, usar datos de demostración
            $mascotasRecientes = $this->getMascotasDemo();
        }

        $stats = [
            'mascotas_rescatadas' => 1200,
            'adopciones_exitosas' => 850,
            'voluntarios_activos' => 150,
            'anos_experiencia' => 5
        ];

        return view('home.index', compact('mascotasRecientes', 'stats'));
    }

    /**
     * Datos de demostración para cuando no hay conexión a BD o no hay mascotas
     */
    private function getMascotasDemo()
    {
        return collect([
            (object)[
                'id' => 1,
                'nombre_mascota' => 'Rocky',  // CAMBIADO: antes era Nombre_mascota
                'especie' => 'Perro',          // CAMBIADO: antes era Especie
                'raza' => 'Mixed',
                'edad_aprox' => 2,             // CAMBIADO: antes era Edad_aprox
                'genero' => 'Macho',            // CAMBIADO: antes era Genero
                'estado' => 'En adopcion',
                'descripcion' => 'Perro juguetón y muy cariñoso. Perfecto para familias activas. Le encanta correr y jugar en el parque.', // CAMBIADO: antes era Descripcion
                'foto_principal' => null,       // CAMBIADO: antes era Foto
                'fundacion' => (object)[
                    'id' => 1,
                    'Nombre_1' => 'Fundación Amigos Peludos'
                ]
            ],
            (object)[
                'id' => 2,
                'nombre_mascota' => 'Luna',
                'especie' => 'Gato',
                'raza' => 'Siamés',
                'edad_aprox' => 1,
                'genero' => 'Hembra',
                'estado' => 'En adopcion',
                'descripcion' => 'Gatita tranquila y cariñosa. Ideal para apartamentos. Le gusta dormir en lugares cálidos y acurrucarse.',
                'foto_principal' => null,
                'fundacion' => (object)[
                    'id' => 2,
                    'Nombre_1' => 'Refugio Felino'
                ]
            ],
            (object)[
                'id' => 3,
                'nombre_mascota' => 'Max',
                'especie' => 'Perro',
                'raza' => 'Labrador',
                'edad_aprox' => 3,
                'genero' => 'Macho',
                'estado' => 'En adopcion',
                'descripcion' => 'Perro tranquilo y protector. Excelente con niños y otros animales. Muy obediente y cariñoso.',
                'foto_principal' => null,
                'fundacion' => (object)[
                    'id' => 3,
                    'Nombre_1' => 'Rescate Animal'
                ]
            ]
        ]);
    }
}
