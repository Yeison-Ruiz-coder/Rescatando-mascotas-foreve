<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donacion;
use App\Models\User;
use App\Models\Fundacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Donacion::with(['user', 'fundacion']);

        // Filtros
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('fundacion_id') && $request->fundacion_id != '') {
            $query->where('fundacion_id', $request->fundacion_id);
        }

        if ($request->has('publica') && $request->publica != '') {
            $query->where('publica', $request->publica);
        }

        if ($request->has('fecha_inicio') && $request->fecha_inicio != '') {
            $query->whereDate('fecha_donacion', '>=', $request->fecha_inicio);
        }

        if ($request->has('fecha_fin') && $request->fecha_fin != '') {
            $query->whereDate('fecha_donacion', '<=', $request->fecha_fin);
        }

        // Ordenamiento
        $orden = $request->get('orden', 'desc');
        $query->orderBy('fecha_donacion', $orden);

        $donaciones = $query->paginate(15);

        // Totales
        $totalDonaciones = Donacion::sum('valor_donacion');
        $totalPublicas = Donacion::where('publica', true)->sum('valor_donacion');
        $totalPrivadas = Donacion::where('publica', false)->sum('valor_donacion');

        // Datos para filtros
        $usuarios = User::whereHas('donaciones')->orderBy('nombre')->get();
        $fundaciones = Fundacion::whereHas('donaciones')->orderBy('Nombre_1')->get();

        return view('admin.donaciones.index', compact(
            'donaciones',
            'totalDonaciones',
            'totalPublicas',
            'totalPrivadas',
            'usuarios',
            'fundaciones'
        ));
    }

    public function create()
    {
        $usuarios = User::orderBy('nombre')->get();
        $fundaciones = Fundacion::orderBy('Nombre_1')->get();

        return view('admin.donaciones.create', compact('usuarios', 'fundaciones'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valor_donacion' => 'required|numeric|min:0',
            'user_id' => 'nullable|exists:users,id',
            'fundacion_id' => 'nullable|exists:fundaciones,id',
            'publica' => 'boolean',
            'fecha_donacion' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Si no se proporciona fecha, se usará la actual (por la migración)

        Donacion::create($data);

        return redirect()->route('admin.donaciones.index')
            ->with('success', 'Donación registrada exitosamente.');
    }

    public function show(Donacion $donacion)
    {
        $donacion->load(['user', 'fundacion']);

        return view('admin.donaciones.show', compact('donacion'));
    }

    public function edit(Donacion $donacion)
    {
        $usuarios = User::orderBy('nombre')->get();
        $fundaciones = Fundacion::orderBy('Nombre_1')->get();

        return view('admin.donaciones.edit', compact('donacion', 'usuarios', 'fundaciones'));
    }

    public function update(Request $request, Donacion $donacion)
    {
        $validator = Validator::make($request->all(), [
            'valor_donacion' => 'required|numeric|min:0',
            'user_id' => 'nullable|exists:users,id',
            'fundacion_id' => 'nullable|exists:fundaciones,id',
            'publica' => 'boolean',
            'fecha_donacion' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $donacion->update($request->all());

        return redirect()->route('admin.donaciones.index')
            ->with('success', 'Donación actualizada exitosamente.');
    }

    public function destroy(Donacion $donacion)
    {
        $donacion->delete();

        return redirect()->route('admin.donaciones.index')
            ->with('success', 'Donación eliminada exitosamente.');
    }

    public function reporte(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'fundacion_id' => 'nullable|exists:fundaciones,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $query = Donacion::whereBetween('fecha_donacion', [$request->fecha_inicio, $request->fecha_fin]);

        if ($request->filled('fundacion_id')) {
            $query->where('fundacion_id', $request->fundacion_id);
        }

        $donaciones = $query->with(['user', 'fundacion'])->get();

        $total = $donaciones->sum('valor_donacion');
        $promedio = $donaciones->avg('valor_donacion');
        $cantidad = $donaciones->count();

        // Agrupar por fundación
        $porFundacion = $donaciones->groupBy(function($item) {
            return $item->fundacion->Nombre_1 ?? 'Sin Fundación';
        })->map(function($grupo) {
            return [
                'cantidad' => $grupo->count(),
                'total' => $grupo->sum('valor_donacion')
            ];
        });

        // 👇 CORREGIDO: Usar compact() y luego with() para las fechas
        return view('admin.donaciones.reporte', compact(
            'donaciones',
            'total',
            'promedio',
            'cantidad',
            'porFundacion'
        ))->with('fecha_inicio', $request->fecha_inicio)
          ->with('fecha_fin', $request->fecha_fin);
    }

    public function togglePublica(Donacion $donacion)
    {
        $donacion->update([
            'publica' => !$donacion->publica
        ]);

        return response()->json([
            'success' => true,
            'publica' => $donacion->publica
        ]);
    }
}
