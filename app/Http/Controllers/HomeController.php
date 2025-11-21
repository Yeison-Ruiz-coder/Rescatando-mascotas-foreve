<?php

namespace App\Http\Controllers;
use App\Models\Mascota;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // App\Http\Controllers\HomeController.php
    // App/Http/Controllers/HomeController.php
    public function index()
    {
        // Si necesitas datos dinámicos para el home
        $mascotasRecientes = Mascota::where('estado', 'En adopcion')
            ->with('fundacion')
            ->latest()
            ->take(3)
            ->get();

        $stats = [
            'mascotas_rescatadas' => 1200,
            'adopciones_exitosas' => 850,
            'voluntarios_activos' => 150,
            'anos_experiencia' => 5
        ];

        return view('home.index', compact('mascotasRecientes', 'stats'));
    }
}
