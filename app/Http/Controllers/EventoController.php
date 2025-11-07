<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Administrador;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('administrador')->get();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        $administradores = Administrador::all();
        return view('eventos.create', compact('administradores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_evento' => 'required|string|max:255',
            'Lugar_evento' => 'required|string|unique:eventos',
            'Descripcion' => 'required|string|unique:eventos'
        ]);

        Evento::create($request->all());

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado exitosamente.');
    }

    public function show($id)
    {
        $evento = Evento::with('administrador')->findOrFail($id);
        return view('eventos.show', compact('evento'));
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        $administradores = Administrador::all();
        return view('eventos.edit', compact('evento', 'administradores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_evento' => 'required|string|max:255',
            'Lugar_evento' => 'required|string|unique:eventos,lugar_evento,' . $id,
            'Descripcion' => 'required|string|unique:eventos,descripcion,' . $id
        ]);

        $evento = Evento::findOrFail($id);
        $evento->update($request->all());

        return redirect()->route('eventos.index')
            ->with('success', 'Evento actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }
}