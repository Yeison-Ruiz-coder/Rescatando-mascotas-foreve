<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            // Verificar conexión a la base de datos
            DB::connection()->getPdo();
            
            // Obtener mascotas disponibles (probando diferentes valores de estado)
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
                'Nombre_mascota' => 'Rocky',
                'Especie' => 'Perro',
                'Raza' => 'Mixed',
                'Edad_aprox' => 2,
                'Genero' => 'Macho',
                'estado' => 'En adopcion',
                'Descripcion' => 'Perro juguetón y muy cariñoso. Perfecto para familias activas. Le encanta correr y jugar en el parque.',
                'Foto' => null,
                'fundacion' => (object)[
                    'id' => 1,
                    'Nombre_1' => 'Fundación Amigos Peludos'
                ]
            ],
            (object)[
                'id' => 2,
                'Nombre_mascota' => 'Luna',
                'Especie' => 'Gato',
                'Raza' => 'Siamés',
                'Edad_aprox' => 1,
                'Genero' => 'Hembra',
                'estado' => 'En adopcion',
                'Descripcion' => 'Gatita tranquila y cariñosa. Ideal para apartamentos. Le gusta dormir en lugares cálidos y acurrucarse.',
                'Foto' => null,
                'fundacion' => (object)[
                    'id' => 2,
                    'Nombre_1' => 'Refugio Felino'
                ]
            ],
            (object)[
                'id' => 3,
                'Nombre_mascota' => 'Max',
                'Especie' => 'Perro',
                'Raza' => 'Labrador',
                'Edad_aprox' => 3,
                'Genero' => 'Macho',
                'estado' => 'En adopcion',
                'Descripcion' => 'Perro tranquilo y protector. Excelente con niños y otros animales. Muy obediente y cariñoso.',
                'Foto' => null,
                'fundacion' => (object)[
                    'id' => 3,
                    'Nombre_1' => 'Rescate Animal'
                ]
            ]
        ]);
    }
}