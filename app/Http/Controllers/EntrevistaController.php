<?php
// app/Http/Controllers/EntrevistaController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entrevista;
use App\Models\Adopcion;
use Illuminate\Http\Request; 

class EntrevistaController extends Controller
{
    // Para ver el historial de entrevistas de una adopción específica
    public function index($adopcionId)
    {
        $adopcion = Adopcion::findOrFail($adopcionId);
        return view('entrevistas.index', compact('adopcion')); 
    }
    
    // Mostrar formulario para crear nueva entrevista
    public function create($adopcionId)
    {
        $adopcion = Adopcion::findOrFail($adopcionId);
        return view('entrevistas.create', compact('adopcion'));
    }
    
    // Para guardar una nueva entrevista/nota de seguimiento
    public function store(Request $request)
    {
        $request->validate([
            'adopcion_id' => 'required|exists:adopciones,id',
            'fecha_entrevista' => 'required|date',
            'notas' => 'required|string',
            'resultado' => 'required|in:Aprobado,Rechazado,Pendiente',
            'admin_id' => 'required|exists:usuarios,id',
        ]);
        
        Entrevista::create($request->all());

        return redirect()->route('adopciones.show', $request->adopcion_id)
                         ->with('success', 'Entrevista de seguimiento guardada.');
    }
}