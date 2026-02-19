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
        return view('admin.reportes.index', compact('reportes'));
    }

    public function create()
    {
        $administradores = Administrador::all();
        return view('admin.reportes.create', compact('administradores'));
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

        return redirect()->route('admin.reportes.index')
            ->with('success', 'Reporte creado exitosamente.');
    }

    public function show($id)
    {
        $reporte = Reporte::with('administrador')->findOrFail($id);
        return view('admin.reportes.show', compact('reporte')); // ✓ CORREGIDO
    }

    public function edit($id)
    {
        $reporte = Reporte::findOrFail($id);
        $administradores = Administrador::all();
        return view('admin.reportes.edit', compact('reporte', 'administradores')); // ✓ CORREGIDO
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

        return redirect()->route('admin.reportes.index')
            ->with('success', 'Reporte actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->delete();

        return redirect()->route('admin.reportes.index')
            ->with('success', 'Reporte eliminado exitosamente.');
    }

    public function generales()
    {
        return view('admin.reportes.generales'); // ✓ DESCOMENTADO
    }

    public function exportar($tipo = null)
    {
        return view('admin.reportes.exportar', compact('tipo')); // ✓ DESCOMENTADO
    }
}
