<?php
// app/Http/Controllers/Admin/DonacionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonacionController extends Controller
{
    /**
     * Constructor para verificar rol de admin
     * TODO: Habilitar cuando se implemente autenticación
     */
    public function __construct()
    {
        // DESHABILITADO TEMPORALMENTE
        /*
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->rol !== 'admin_fundacion') {
                abort(403, 'No tienes permiso para acceder a este recurso');
            }
            return $next($request);
        });
        */
    }

    /**
     * Ver donaciones de la fundación del admin
     */
    public function index()
    {
        // TODO: Descomentar cuando esté la autenticación
        // $donaciones = Donacion::with('usuario')
        //     ->where('fundacion_id', Auth::user()->fundacion_id)
        //     ->latest()
        //     ->paginate(15);

        // TEMPORALMENTE: mostrar todas las donaciones
        $donaciones = Donacion::with('usuario')
            ->latest()
            ->paginate(15);

        return view('admin.donaciones.index', compact('donaciones'));
    }

    /**
     * Ver detalle de una donación (de su fundación)
     */
    public function show($id)
    {
        // TODO: Descomentar cuando esté la autenticación
        // $donacion = Donacion::with('usuario')
        //     ->where('fundacion_id', Auth::user()->fundacion_id)
        //     ->findOrFail($id);

        // TEMPORALMENTE: mostrar cualquier donación
        $donacion = Donacion::with('usuario')
            ->findOrFail($id);

        return view('admin.donaciones.show', compact('donacion'));
    }

    /**
     * Actualizar estado de la donación
     */
    public function updateEstado(Request $request, $id)
    {
        // TODO: Descomentar cuando esté la autenticación
        // $donacion = Donacion::where('fundacion_id', Auth::user()->fundacion_id)
        //     ->findOrFail($id);

        // TEMPORALMENTE: actualizar cualquier donación
        $donacion = Donacion::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,rechazada'
        ]);

        $donacion->update(['estado' => $request->estado]);

        return back()->with('success', 'Estado actualizado');
    }

    /**
     * Reportes (solo admin)
     */
    public function reportes()
    {
        // TODO: Descomentar cuando esté la autenticación
        // $donaciones = Donacion::where('fundacion_id', Auth::user()->fundacion_id)
        //     ->selectRaw('DATE(Fecha_donacion) as fecha, COUNT(*) as total, SUM(valor_donacion) as monto_total')
        //     ->groupBy('fecha')
        //     ->orderBy('fecha', 'desc')
        //     ->paginate(15);

        // TEMPORALMENTE: mostrar reportes de todas las donaciones
        $donaciones = Donacion::selectRaw('DATE(Fecha_donacion) as fecha, COUNT(*) as total, SUM(valor_donacion) as monto_total')
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('admin.donaciones.reportes', compact('donaciones'));
    }
}
