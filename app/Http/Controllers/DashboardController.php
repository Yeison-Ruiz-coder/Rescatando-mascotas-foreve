<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Usuario;
use App\Models\Adopcion;
use App\Models\Donacion;
use App\Models\Rescate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_mascotas' => Mascota::count(),
            'mascotas_adopcion' => Mascota::where('estado', 'En adopcion')->count(),
            'total_usuarios' => Usuario::count(),
            'adopciones_pendientes' => Adopcion::where('estado', 'En proceso')->count(),
            'total_donaciones' => Donacion::sum('valor_donacion'),
            'total_rescates' => Rescate::count()
        ];

        $mascotas_recientes = Mascota::with('fundacion')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'mascotas_recientes'));
    }
}