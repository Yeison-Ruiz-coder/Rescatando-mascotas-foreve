<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // Mostrar comentarios en la página pública de una mascota/evento
    public function index($entidadTipo, $entidadId)
    {
        $comentarios = Comentario::where('comentable_type', $entidadTipo)
                                 ->where('comentable_id', $entidadId)
                                 ->where('aprobado', true)
                                 ->with('usuario')
                                 ->get();

        return view('public.comentarios.index', compact('comentarios'));
    }

    // Guardar comentario desde el frontend
    public function store(Request $request)
    {
        $request->validate([
            'Contenido' => 'required|string|min:3',
            'entidad_tipo' => 'required|string',
            'entidad_id' => 'required|integer',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        $comentario = Comentario::create([
            'Contenido' => $request->Contenido,
            'Fecha' => now(),
            'usuario_id' => $request->usuario_id,
            'comentable_type' => $request->entidad_tipo,
            'comentable_id' => $request->entidad_id,
            'aprobado' => false // Requiere aprobación del admin
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comentario enviado para revisión',
            'comentario' => $comentario
        ]);
    }
}
