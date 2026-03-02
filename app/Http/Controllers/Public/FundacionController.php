<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Fundacion;
use App\Models\Mascota;
use Illuminate\Http\Request;

class FundacionController extends Controller
{
    /**
     * Listado de fundaciones
     */
    public function index(Request $request)
    {
        $query = Fundacion::withCount('mascotas');

        // Filtro por voluntarios
        if ($request->filled('voluntarios')) {
            $query->where('recibe_voluntarios', true);
        }

        // Búsqueda por nombre
        if ($request->filled('buscar')) {
            $query->where('Nombre_1', 'like', '%' . $request->buscar . '%');
        }

        $fundaciones = $query->paginate(12);

        return view('public.fundaciones.index', compact('fundaciones'));
    }

    /**
     * Detalle de fundación
     */
    public function show($id)
    {
        $fundacion = Fundacion::withCount('mascotas')->findOrFail($id);

        $mascotas = Mascota::where('fundacion_id', $id)
                           ->where('estado', 'En adopcion')
                           ->limit(6)
                           ->get();

        $necesidades = json_decode($fundacion->necesidades_actuales, true) ?? [];

        return view('public.fundaciones.show', compact('fundacion', 'mascotas', 'necesidades'));
    }

    /**
     * Formulario de contacto con fundación
     */
    public function contacto(Request $request, $id)
    {
        $fundacion = Fundacion::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'mensaje' => 'required|string',
        ]);

        // Aquí enviarías email a la fundación
        // Mail::to($fundacion->Email)->send(new ContactoFundacion($request->all()));

        return back()->with('success', 'Mensaje enviado a la fundación');
    }
}
