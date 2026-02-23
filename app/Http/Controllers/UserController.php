<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Administrador;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('administrador')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $administradores = Administrador::all();
        return view('users.create', compact('administradores'));
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        $datos['Password_user'] = bcrypt($request->Password_user);
        User::create($datos);
        return redirect()->route('users.index')
            ->with('success', 'User creado exitosamente.');
    }

    public function show($id)
    {
        $user = User::with([
            'administrador',
            'comentarios',
            'solicitudes',
            'suscripciones',
            'adopciones',
            'donaciones'
        ])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $administradores = Administrador::all();
        return view('users.edit', compact('user', 'administradores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validación de campos
            'email' => 'required|email|unique:users,email,' . $id,
            'Password_user' => 'nullable|min:6|confirmed',
            // Otras validaciones según tus necesidades
        ]);

        $user = User::findOrFail($id);
        $datos = $request->all();

        if ($request->filled('Password_user')) {
            $datos['Password_user'] = bcrypt($request->Password_user);
        } else {
            unset($datos['Password_user']);
        }

        $user->update($datos);

        return redirect()->route('users.index')
            ->with('success', 'User actualizado exitosamente.');
    }
}
