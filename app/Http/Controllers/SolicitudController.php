<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Usuario;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::with('usuario')->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('solicitudes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:Para Adoptar,Para Rescatar,Para Apadrinar,Para Donar',
            'Contenido' => 'required|string',
            'Fecha_solicitud' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        Solicitud::create($request->all());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud creada exitosamente.');
    }

    public function show($id)
    {
        $solicitud = Solicitud::with('usuario')->findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $usuarios = Usuario::all();
        return view('solicitudes.edit', compact('solicitud', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|in:Para Adoptar,Para Rescatar,Para Apadrinar,Para Donar',
            'Contenido' => 'required|string',
            'Fecha_solicitud' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud eliminada exitosamente.');
    }
}