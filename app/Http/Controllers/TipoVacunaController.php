<?php

namespace App\Http\Controllers;

use App\Models\TipoVacuna; // Asegúrate de que este sea el nombre correcto de tu modelo
use Illuminate\Http\Request;

class TipoVacunaController extends Controller
{
    // Muestra una lista de todos los tipos de vacunas (Admin Index)
    public function index()
    {
        $tiposVacunas = TipoVacuna::all();
        return view('tipos_vacunas.index', compact('tiposVacunas'));
    }

    // Muestra el formulario para crear un nuevo tipo de vacuna
    public function create()
    {
        return view('tipos_vacunas.create');
    }

    // Almacena un nuevo tipo de vacuna en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_vacuna' => 'required|unique:tipos_vacunas,nombre_vacuna|max:255',
            'frecuencia_dias' => 'nullable|integer|min:0', // El campo que definimos para la frecuencia
        ]);

        TipoVacuna::create($request->all());

        return redirect()->route('tipos_vacunas.index')
                         ->with('success', 'Tipo de vacuna creado exitosamente.');
    }

    // Muestra el detalle de un tipo de vacuna específico
    public function show(TipoVacuna $tipos_vacuna)
    {
        return view('tipos_vacunas.show', compact('tipos_vacuna'));
    }

    // Muestra el formulario para editar un tipo de vacuna
    public function edit(TipoVacuna $tipos_vacuna)
    {
        return view('tipos_vacunas.edit', compact('tipos_vacuna'));
    }

    // Actualiza el tipo de vacuna en la base de datos
    public function update(Request $request, TipoVacuna $tipos_vacuna)
    {
        $request->validate([
            'nombre_vacuna' => 'required|unique:tipos_vacunas,nombre_vacuna,' . $tipos_vacuna->id . '|max:255',
            'frecuencia_dias' => 'nullable|integer|min:0',
        ]);

        $tipos_vacuna->update($request->all());

        return redirect()->route('tipos_vacunas.index')
                         ->with('success', 'Tipo de vacuna actualizado exitosamente.');
    }

    // Elimina un tipo de vacuna
    public function destroy(TipoVacuna $tipos_vacuna)
    {
        $tipos_vacuna->delete();

        return redirect()->route('tipos_vacunas.index')
                         ->with('success', 'Tipo de vacuna eliminado correctamente.');
    }
}