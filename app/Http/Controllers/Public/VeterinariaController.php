<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Veterinaria;
use Illuminate\Http\Request;

class VeterinariaController extends Controller
{
    /**
     * Listado de veterinarias
     */
    public function index(Request $request)
    {
        $query = Veterinaria::query();

        // Filtro por urgencias 24h
        if ($request->filled('urgencias')) {
            $query->where('urgencias_24h', true);
        }

        // Búsqueda por ciudad/dirección
        if ($request->filled('ubicacion')) {
            $query->where('Direccion', 'like', '%' . $request->ubicacion . '%');
        }

        $veterinarias = $query->paginate(12);

        return view('public.veterinarias.index', compact('veterinarias'));
    }

    /**
     * Detalle de veterinaria
     */
    public function show($id)
    {
        $veterinaria = Veterinaria::findOrFail($id);

        // Veterinarias cercanas (simulado por ahora)
        $cercanas = Veterinaria::where('id', '!=', $id)
                               ->limit(3)
                               ->get();

        return view('public.veterinarias.show', compact('veterinaria', 'cercanas'));
    }

    /**
     * Mapa de veterinarias
     */
    public function mapa()
    {
        $veterinarias = Veterinaria::all();
        return view('public.veterinarias.mapa', compact('veterinarias'));
    }
}
