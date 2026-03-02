<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtros
        if ($request->has('tipo') && $request->tipo != '') {
            $query->where('tipo', $request->tipo);
        }

        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('numero_documento', 'like', "%{$search}%");
            });
        }

        $usuarios = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'tipo' => 'required|in:admin,user,veterinaria,fundacion',
            'estado' => 'required|in:activo,inactivo,suspendido,pendiente',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'tipo_documento' => 'nullable|string|max:50',
            'numero_documento' => 'nullable|string|max:50|unique:users',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['password', 'password_confirmation', 'avatar']);
        $data['password'] = Hash::make($request->password);

        // Auditoría
        $data['created_by'] = auth()->id();

        // Subir avatar si existe
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $usuario = User::create($data);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        // Cargar relaciones según el tipo de usuario
        if ($usuario->tipo === 'fundacion') {
            $usuario->load('fundacion');
        } elseif ($usuario->tipo === 'veterinaria') {
            $usuario->load('veterinaria');
        }

        // Estadísticas del usuario
        $stats = [
            'adopciones' => $usuario->adopciones()->count(),
            'donaciones' => $usuario->donaciones()->sum('valor_donacion'),
            'apadrinamientos' => $usuario->apadrinamientos()->where('estado', 'activo')->count(),
            'reportes' => $usuario->reportes()->count(),
            'solicitudes' => $usuario->solicitudes()->count(),
        ];

        return view('admin.usuarios.show', compact('usuario', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'tipo' => 'required|in:admin,user,veterinaria,fundacion',
            'estado' => 'required|in:activo,inactivo,suspendido,pendiente',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'tipo_documento' => 'nullable|string|max:50',
            'numero_documento' => 'nullable|string|max:50|unique:users,numero_documento,' . $usuario->id,
            'avatar' => 'nullable|image|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['password', 'password_confirmation', 'avatar']);

        // Auditoría
        $data['updated_by'] = auth()->id();

        // Actualizar contraseña solo si se proporciona
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Subir nuevo avatar si existe
        if ($request->hasFile('avatar')) {
            // Eliminar avatar anterior si existe
            if ($usuario->avatar) {
                \Storage::disk('public')->delete($usuario->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        // Verificar si tiene relaciones activas
        $hasRelations = $usuario->adopciones()->exists() ||
                       $usuario->apadrinamientos()->exists() ||
                       $usuario->donaciones()->exists() ||
                       $usuario->mascotas()->exists();

        if ($hasRelations) {
            return redirect()->route('admin.usuarios.index')
                ->with('error', 'No se puede eliminar el usuario porque tiene registros asociados.');
        }

        // Eliminar avatar si existe
        if ($usuario->avatar) {
            \Storage::disk('public')->delete($usuario->avatar);
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    /**
     * Cambiar estado del usuario
     */
    public function cambiarEstado(Request $request, User $usuario)
    {
        $request->validate([
            'estado' => 'required|in:activo,inactivo,suspendido,pendiente'
        ]);

        $usuario->update([
            'estado' => $request->estado,
            'updated_by' => auth()->id()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente'
        ]);
    }

    /**
     * Verificar email
     */
    public function verificarEmail(User $usuario)
    {
        $usuario->update([
            'email_verified_at' => now(),
            'updated_by' => auth()->id()
        ]);

        return redirect()->back()
            ->with('success', 'Email verificado correctamente.');
    }
}
