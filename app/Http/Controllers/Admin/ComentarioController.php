<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Comentario::with('user');

        // Filtros
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('fecha_inicio') && $request->fecha_inicio != '') {
            $query->whereDate('fecha', '>=', $request->fecha_inicio);
        }

        if ($request->has('fecha_fin') && $request->fecha_fin != '') {
            $query->whereDate('fecha', '<=', $request->fecha_fin);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('contenido', 'like', "%{$request->search}%");
        }

        $comentarios = $query->orderBy('fecha', 'desc')->paginate(15);

        // Estadísticas
        $stats = [
            'total' => Comentario::count(),
            'hoy' => Comentario::whereDate('fecha', today())->count(),
            'esta_semana' => Comentario::whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'usuarios_activos' => Comentario::distinct('user_id')->count('user_id'),
        ];

        // Usuarios para filtro
        $usuarios = User::whereHas('comentarios')->orderBy('nombre')->get();

        return view('admin.comentarios.index', compact('comentarios', 'stats', 'usuarios'));
    }

    public function create()
    {
        $usuarios = User::where('estado', 'activo')->orderBy('nombre')->get();

        return view('admin.comentarios.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Si no se proporciona fecha, se usará la actual (por la migración)

        Comentario::create($data);

        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentario creado exitosamente.');
    }

    public function show(Comentario $comentario)
    {
        $comentario->load('user');

        return view('admin.comentarios.show', compact('comentario'));
    }

    public function edit(Comentario $comentario)
    {
        $usuarios = User::where('estado', 'activo')->orderBy('nombre')->get();

        return view('admin.comentarios.edit', compact('comentario', 'usuarios'));
    }

    public function update(Request $request, Comentario $comentario)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comentario->update($request->all());

        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentario actualizado exitosamente.');
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();

        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentario eliminado exitosamente.');
    }

    public function masivo(Request $request)
    {
        $request->validate([
            'accion' => 'required|in:eliminar,ocultar',
            'comentarios' => 'required|array',
            'comentarios.*' => 'exists:comentarios,id'
        ]);

        if ($request->accion === 'eliminar') {
            Comentario::whereIn('id', $request->comentarios)->delete();
            $mensaje = 'Comentarios eliminados exitosamente.';
        }

        return redirect()->route('admin.comentarios.index')
            ->with('success', $mensaje);
    }
}
