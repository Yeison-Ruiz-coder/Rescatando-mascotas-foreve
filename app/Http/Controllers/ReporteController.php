<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Administrador;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with('administrador')->get();
        return view('reportes.index', compact('reportes'));
    }

    public function create()
    {
        $administradores = Administrador::all();
        return view('reportes.create', compact('administradores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_rep' => 'nullable|string|max:255',
            'Fecha_reporte' => 'nullable|date',
            'Descripcion' => 'nullable|string',
            'Email' => 'required|email'
        ]);

        Reporte::create($request->all());

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte creado exitosamente.');
    }

    public function show($id)
    {
        $reporte = Reporte::with('administrador')->findOrFail($id);
        return view('reportes.show', compact('reporte'));
    }

    public function edit($id)
    {
        $reporte = Reporte::findOrFail($id);
        $administradores = Administrador::all();
        return view('reportes.edit', compact('reporte', 'administradores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_rep' => 'nullable|string|max:255',
            'Fecha_reporte' => 'nullable|date',
            'Descripcion' => 'nullable|string',
            'Email' => 'required|email'
        ]);

        $reporte = Reporte::findOrFail($id);
        $reporte->update($request->all());

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->delete();

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte eliminado exitosamente.');
    }
}