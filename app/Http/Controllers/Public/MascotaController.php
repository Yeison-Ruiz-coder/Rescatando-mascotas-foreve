<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\Raza;
use App\Models\Fundacion;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Listado público de mascotas
     */
    public function index(Request $request)
    {
        $query = Mascota::with('fundacion', 'razas')
                       ->where('estado', 'En adopcion');

        // Filtros
        if ($request->filled('especie')) {
            $query->where('especie', $request->especie);
        }

        if ($request->filled('raza_id')) {
            $query->whereHas('razas', function ($q) use ($request) {
                $q->where('razas.id', $request->raza_id);
            });
        }

        if ($request->filled('fundacion_id')) {
            $query->where('fundacion_id', $request->fundacion_id);
        }

        if ($request->filled('edad_min')) {
            $query->where('edad_aprox', '>=', $request->edad_min);
        }

        if ($request->filled('edad_max')) {
            $query->where('edad_aprox', '<=', $request->edad_max);
        }

        if ($request->filled('genero')) {
            $query->where('genero', $request->genero);
        }

        if ($request->filled('apto_con_ninos')) {
            $query->where('apto_con_ninos', true);
        }

        if ($request->filled('apto_con_otros_animales')) {
            $query->where('apto_con_otros_animales', true);
        }

        // Búsqueda por nombre
        if ($request->filled('buscar')) {
            $query->where('nombre_mascota', 'like', '%' . $request->buscar . '%');
        }

        // Ordenamiento
        switch ($request->get('orden', 'reciente')) {
            case 'nombre_asc':
                $query->orderBy('nombre_mascota', 'asc');
                break;
            case 'nombre_desc':
                $query->orderBy('nombre_mascota', 'desc');
                break;
            case 'edad_asc':
                $query->orderBy('edad_aprox', 'asc');
                break;
            case 'edad_desc':
                $query->orderBy('edad_aprox', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $mascotas = $query->paginate(12);

        // Datos para filtros
        $especies = Mascota::where('estado', 'En adopcion')
                          ->distinct('especie')
                          ->pluck('especie');
        $razas = Raza::all();
        $fundaciones = Fundacion::whereHas('mascotas', function ($q) {
            $q->where('estado', 'En adopcion');
        })->get();

        return view('public.mascotas.index', compact(
            'mascotas',
            'especies',
            'razas',
            'fundaciones'
        ));
    }

    /**
     * Detalle de mascota
     */
    public function show($id)
    {
        $mascota = Mascota::with(['fundacion', 'razas', 'vacunas', 'historialMedico'])
                          ->findOrFail($id);

        // Mascotas relacionadas (misma especie, misma fundación)
        $relacionadas = Mascota::where('estado', 'En adopcion')
                               ->where('id', '!=', $mascota->id)
                               ->where(function ($q) use ($mascota) {
                                   $q->where('especie', $mascota->especie)
                                     ->orWhere('fundacion_id', $mascota->fundacion_id);
                               })
                               ->limit(4)
                               ->get();

        return view('public.mascotas.show', compact('mascota', 'relacionadas'));
    }

    /**
     * Mascotas por fundación
     */
    public function porFundacion($fundacionId)
    {
        $fundacion = Fundacion::findOrFail($fundacionId);

        $mascotas = Mascota::where('fundacion_id', $fundacionId)
                           ->where('estado', 'En adopcion')
                           ->paginate(12);

        return view('public.mascotas.fundacion', compact('mascotas', 'fundacion'));
    }
}
