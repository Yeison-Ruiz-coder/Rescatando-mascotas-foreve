<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Notificacion::with(['user', 'creador']);

        // Filtros
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('creado_por_id') && $request->creado_por_id != '') {
            $query->where('creado_por_id', $request->creado_por_id);
        }

        if ($request->has('fecha_inicio') && $request->fecha_inicio != '') {
            $query->whereDate('fecha_envio', '>=', $request->fecha_inicio);
        }

        if ($request->has('fecha_fin') && $request->fecha_fin != '') {
            $query->whereDate('fecha_envio', '<=', $request->fecha_fin);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('contenido', 'like', "%{$request->search}%");
        }

        $notificaciones = $query->orderBy('fecha_envio', 'desc')->paginate(15);

        // Estadísticas
        $stats = [
            'total' => Notificacion::count(),
            'hoy' => Notificacion::whereDate('fecha_envio', today())->count(),
            'usuarios_notificados' => Notificacion::distinct('user_id')->count('user_id'),
        ];

        // Datos para filtros
        $usuarios = User::orderBy('nombre')->get();
        $administradores = User::where('tipo', 'admin')->orderBy('nombre')->get();

        return view('admin.notificaciones.index', compact('notificaciones', 'stats', 'usuarios', 'administradores'));
    }

    public function create()
    {
        $usuarios = User::where('estado', 'activo')->orderBy('nombre')->get();

        return view('admin.notificaciones.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'fecha_envio' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['creado_por_id'] = auth()->id();

        Notificacion::create($data);

        return redirect()->route('admin.notificaciones.index')
            ->with('success', 'Notificación enviada exitosamente.');
    }

    public function show(Notificacion $notificacione) // Nota: el nombre es notificacione por la migración
    {
        $notificacione->load(['user', 'creador']);

        return view('admin.notificaciones.show', compact('notificacione'));
    }

    public function edit(Notificacion $notificacione)
    {
        $usuarios = User::where('estado', 'activo')->orderBy('nombre')->get();

        return view('admin.notificaciones.edit', compact('notificacione', 'usuarios'));
    }

    public function update(Request $request, Notificacion $notificacione)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'fecha_envio' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $notificacione->update($request->all());

        return redirect()->route('admin.notificaciones.index')
            ->with('success', 'Notificación actualizada exitosamente.');
    }

    public function destroy(Notificacion $notificacione)
    {
        $notificacione->delete();

        return redirect()->route('admin.notificaciones.index')
            ->with('success', 'Notificación eliminada exitosamente.');
    }

    public function enviarMasivo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => 'required|string',
            'tipo_destinatarios' => 'required|in:todos,usuarios,administradores,fundaciones,veterinarias',
            'fecha_envio' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Construir query de destinatarios
        $query = User::where('estado', 'activo');

        switch ($request->tipo_destinatarios) {
            case 'administradores':
                $query->where('tipo', 'admin');
                break;
            case 'fundaciones':
                $query->where('tipo', 'fundacion');
                break;
            case 'veterinarias':
                $query->where('tipo', 'veterinaria');
                break;
            case 'usuarios':
                $query->where('tipo', 'user');
                break;
            // 'todos' no necesita filtro adicional
        }

        $destinatarios = $query->get();

        // Crear notificación para cada destinatario
        foreach ($destinatarios as $destinatario) {
            Notificacion::create([
                'contenido' => $request->contenido,
                'user_id' => $destinatario->id,
                'creado_por_id' => auth()->id(),
                'fecha_envio' => $request->fecha_envio ?? now(),
            ]);
        }

        return redirect()->route('admin.notificaciones.index')
            ->with('success', "Notificaciones enviadas a {$destinatarios->count()} usuarios.");
    }
}
