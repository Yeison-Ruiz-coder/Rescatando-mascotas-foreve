<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apadrinamiento;
use App\Models\User;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApadrinamientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Apadrinamiento::with(['user', 'mascota']);

        // Filtros
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        if ($request->has('frecuencia') && $request->frecuencia != '') {
            $query->where('frecuencia', $request->frecuencia);
        }

        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('mascota_id') && $request->mascota_id != '') {
            $query->where('mascota_id', $request->mascota_id);
        }

        if ($request->has('fecha_inicio') && $request->fecha_inicio != '') {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio);
        }

        if ($request->has('fecha_fin') && $request->fecha_fin != '') {
            $query->whereDate('fecha_inicio', '<=', $request->fecha_fin);
        }

        // Excluir cancelados/finalizados para activos por defecto
        if ($request->has('activos') && $request->activos) {
            $query->whereIn('estado', ['activo', 'pausado']);
        }

        $apadrinamientos = $query->orderBy('created_at', 'desc')->paginate(15);

        // Estadísticas
        $stats = [
            'total_mensual' => Apadrinamiento::whereIn('estado', ['activo', 'pausado'])->sum('monto_mensual'),
            'activos' => Apadrinamiento::where('estado', 'activo')->count(),
            'pausados' => Apadrinamiento::where('estado', 'pausado')->count(),
            'cancelados' => Apadrinamiento::where('estado', 'cancelado')->count(),
        ];

        // Datos para filtros
        $usuarios = User::whereHas('apadrinamientos')->orderBy('nombre')->get();
        $mascotas = Mascota::whereHas('apadrinamientos')->orderBy('nombre_mascota')->get();

        return view('admin.apadrinamientos.index', compact('apadrinamientos', 'stats', 'usuarios', 'mascotas'));
    }

    public function create()
    {
        $usuarios = User::where('estado', 'activo')->orderBy('nombre')->get();
        $mascotas = Mascota::whereIn('estado', ['En adopcion', 'Rescatada', 'En acogida'])
            ->orderBy('nombre_mascota')
            ->get();

        return view('admin.apadrinamientos.create', compact('usuarios', 'mascotas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'monto_mensual' => 'required|numeric|min:1',
            'frecuencia' => 'required|in:unica,mensual,trimestral,anual',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'estado' => 'required|in:activo,pausado,cancelado,finalizado',
            'mensaje_apoyo' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar que la mascota no tenga ya un apadrinamiento activo
        if (in_array($request->estado, ['activo', 'pausado'])) {
            $existeActivo = Apadrinamiento::where('mascota_id', $request->mascota_id)
                ->whereIn('estado', ['activo', 'pausado'])
                ->exists();

            if ($existeActivo) {
                return redirect()->back()
                    ->with('error', 'Esta mascota ya tiene un apadrinamiento activo o pausado.')
                    ->withInput();
            }
        }

        Apadrinamiento::create($request->all());

        return redirect()->route('admin.apadrinamientos.index')
            ->with('success', 'Apadrinamiento creado exitosamente.');
    }

    public function show(Apadrinamiento $apadrinamiento)
    {
        $apadrinamiento->load(['user', 'mascota']);

        // Calcular total aportado (simulado - en realidad necesitarías tabla de pagos)
        $mesesActivo = now()->diffInMonths($apadrinamiento->fecha_inicio);
        $totalAportado = $apadrinamiento->monto_mensual * $mesesActivo;

        return view('admin.apadrinamientos.show', compact('apadrinamiento', 'totalAportado'));
    }

    public function edit(Apadrinamiento $apadrinamiento)
    {
        $usuarios = User::where('estado', 'activo')->orderBy('nombre')->get();
        $mascotas = Mascota::orderBy('nombre_mascota')->get();

        return view('admin.apadrinamientos.edit', compact('apadrinamiento', 'usuarios', 'mascotas'));
    }

    public function update(Request $request, Apadrinamiento $apadrinamiento)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'monto_mensual' => 'required|numeric|min:1',
            'frecuencia' => 'required|in:unica,mensual,trimestral,anual',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'estado' => 'required|in:activo,pausado,cancelado,finalizado',
            'mensaje_apoyo' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar que no haya otro apadrinamiento activo para la misma mascota
        if (in_array($request->estado, ['activo', 'pausado'])) {
            $existeActivo = Apadrinamiento::where('mascota_id', $request->mascota_id)
                ->where('id', '!=', $apadrinamiento->id)
                ->whereIn('estado', ['activo', 'pausado'])
                ->exists();

            if ($existeActivo) {
                return redirect()->back()
                    ->with('error', 'Esta mascota ya tiene otro apadrinamiento activo o pausado.')
                    ->withInput();
            }
        }

        $apadrinamiento->update($request->all());

        return redirect()->route('admin.apadrinamientos.index')
            ->with('success', 'Apadrinamiento actualizado exitosamente.');
    }

    public function destroy(Apadrinamiento $apadrinamiento)
    {
        $apadrinamiento->delete();

        return redirect()->route('admin.apadrinamientos.index')
            ->with('success', 'Apadrinamiento eliminado exitosamente.');
    }

    public function cambiarEstado(Request $request, Apadrinamiento $apadrinamiento)
    {
        $request->validate([
            'estado' => 'required|in:activo,pausado,cancelado,finalizado'
        ]);

        // Si va a activar o pausar, verificar que no haya conflicto
        if (in_array($request->estado, ['activo', 'pausado'])) {
            $existeActivo = Apadrinamiento::where('mascota_id', $apadrinamiento->mascota_id)
                ->where('id', '!=', $apadrinamiento->id)
                ->whereIn('estado', ['activo', 'pausado'])
                ->exists();

            if ($existeActivo) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede activar porque la mascota ya tiene otro apadrinamiento activo.'
                ], 422);
            }
        }

        $apadrinamiento->update(['estado' => $request->estado]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente'
        ]);
    }

    public function vencimientos()
    {
        // Apadrinamientos que vencen en los próximos 30 días
        $proximosVencer = Apadrinamiento::with(['user', 'mascota'])
            ->whereIn('estado', ['activo', 'pausado'])
            ->whereNotNull('fecha_fin')
            ->whereBetween('fecha_fin', [now(), now()->addDays(30)])
            ->orderBy('fecha_fin')
            ->get();

        return view('admin.apadrinamientos.vencimientos', compact('proximosVencer'));
    }
}
