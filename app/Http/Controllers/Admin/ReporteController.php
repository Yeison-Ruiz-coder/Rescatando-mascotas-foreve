<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\Rescate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReporteController extends Controller
{
    /**
     * Listado de reportes
     */
    public function index(Request $request)
    {
        $query = Reporte::with('usuario', 'resueltoPor');

        if ($request->filled('tipo_reporte')) {
            $query->where('tipo_reporte', $request->tipo_reporte);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $reportes = $query->latest()->paginate(20);

        return view('admin.reportes.index', compact('reportes'));
    }

    /**
     * Mostrar reporte
     */
    public function show($id)
    {
        $reporte = Reporte::with('usuario', 'resueltoPor')->findOrFail($id);
        return view('admin.reportes.show', compact('reporte'));
    }

    /**
     * Formulario de edición
     */
    public function edit($id)
    {
        $reporte = Reporte::findOrFail($id);
        return view('admin.reportes.edit', compact('reporte'));
    }

    /**
     * Actualizar reporte
     */
    public function update(Request $request, $id)
    {
        $reporte = Reporte::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:activo,resuelto,cerrado',
            'solucion' => 'nullable|string',
        ]);

        $reporte->update([
            'estado' => $request->estado,
            'solucion' => $request->solucion,
            'resuelto_por' => $request->estado === 'resuelto' ? auth()->id() : $reporte->resuelto_por,
            'fecha_resolucion' => $request->estado === 'resuelto' ? now() : $reporte->fecha_resolucion,
        ]);

        return redirect()->route('admin.reportes.show', $id)
            ->with('success', 'Reporte actualizado');
    }

    /**
     * Eliminar reporte
     */
    public function destroy($id)
    {
        $reporte = Reporte::findOrFail($id);

        if ($reporte->foto_url) {
            Storage::disk('public')->delete($reporte->foto_url);
        }

        $reporte->delete();

        return redirect()->route('admin.reportes.index')
            ->with('success', 'Reporte eliminado');
    }

    /**
     * Convertir reporte en rescate
     */
    public function convertirARescate(Request $request, $id)
    {
        $reporte = Reporte::findOrFail($id);

        $request->validate([
            'fecha_rescate' => 'required|date',
            'lugar_rescate' => 'required|string',
            'descripcion_rescate' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $rescate = Rescate::create([
                'fecha_rescate' => $request->fecha_rescate,
                'lugar_rescate' => $request->lugar_rescate,
                'descripcion_rescate' => $request->descripcion_rescate,
                'estado' => 'en_proceso',
                'reporte_id' => $reporte->id,
                'usuario_reporto_id' => $reporte->user_id,
                'administrador_gestion_id' => auth()->id(),
            ]);

            $reporte->update(['estado' => 'resuelto']);

            DB::commit();

            return redirect()->route('admin.rescates.show', $rescate->id)
                ->with('success', 'Rescate creado a partir del reporte');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear rescate');
        }
    }

    /**
     * Reportes generales (estadísticas)
     */
    public function generales()
    {
        $reportesPorTipo = Reporte::select('tipo_reporte', DB::raw('count(*) as total'))
            ->groupBy('tipo_reporte')
            ->get();

        $reportesPorMes = Reporte::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $tiempoResolucion = Reporte::whereNotNull('fecha_resolucion')
            ->select(DB::raw('AVG(DATEDIFF(fecha_resolucion, created_at)) as promedio_dias'))
            ->first();

        return view('admin.reportes.generales', compact(
            'reportesPorTipo',
            'reportesPorMes',
            'tiempoResolucion'
        ));
    }

    /**
     * Exportar reportes
     */
    public function exportar(Request $request, $tipo = 'pdf')
    {
        return view('admin.reportes.exportar');
    }
}
