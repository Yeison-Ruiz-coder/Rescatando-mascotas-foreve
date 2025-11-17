@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="fw-bold mb-0">Registrar Nuevo Usuario</h2>
                </div>

                <div class="card-body p-4">
                    {{-- Mostrar errores de validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulario POST que apunta a UsuarioController@store --}}
                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf
                        
                        <div class="row">
                            {{-- COLUMNA 1: Datos Personales --}}
                            <div class="col-md-6">
                                <h4 class="text-info mb-3">Identificación</h4>

                                <div class="mb-3">
                                    <label for="Nombre_1" class="form-label">Primer Nombre</label>
                                    <input type="text" name="Nombre_1" class="form-control" value="{{ old('Nombre_1') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Nombre_2" class="form-label">Segundo Nombre (Opcional)</label>
                                    <input type="text" name="Nombre_2" class="form-control" value="{{ old('Nombre_2') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="Apellido_1" class="form-label">Primer Apellido</label>
                                    <input type="text" name="Apellido_1" class="form-control" value="{{ old('Apellido_1') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Apellido_2" class="form-label">Segundo Apellido (Opcional)</label>
                                    <input type="text" name="Apellido_2" class="form-control" value="{{ old('Apellido_2') }}">
                                </div>
                            </div>
                            
                            {{-- COLUMNA 2: Contacto y Rol --}}
                            <div class="col-md-6">
                                <h4 class="text-info mb-3">Contacto y Sistema</h4>
                                
                                <div class="mb-3">
                                    <label for="Fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" name="Fecha_nacimiento" class="form-control" value="{{ old('Fecha_nacimiento') }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" name="Email" class="form-control" value="{{ old('Email') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Telefono" class="form-label">Teléfono</label>
                                    <input type="text" name="Telefono" class="form-control" value="{{ old('Telefono') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Direccion" class="form-label">Dirección</label>
                                    <input type="text" name="Direccion" class="form-control" value="{{ old('Direccion') }}" required>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        
                        {{-- ROLES Y CONTRASEÑA --}}
                        <h4 class="text-warning mb-3">Configuración de Acceso y Rol</h4>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo de Usuario / Rol</label>
                                <select name="tipo" id="tipo" class="form-select" required>
                                    <option value="Cliente" {{ old('tipo') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                                    <option value="Voluntario" {{ old('tipo') == 'Voluntario' ? 'selected' : '' }}>Voluntario</option>
                                    <option value="Rescatista" {{ old('tipo') == 'Rescatista' ? 'selected' : '' }}>Rescatista</option>
                                    <option value="Administrador" {{ old('tipo') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="administrador_id" class="form-label">Administrador Responsable (Opcional)</label>
                                <select name="administrador_id" id="administrador_id" class="form-select">
                                    <option value="">Ninguno</option>
                                    @foreach ($administradores as $admin)
                                        <option value="{{ $admin->id }}" 
                                                {{ old('administrador_id') == $admin->id ? 'selected' : '' }}>
                                            {{ $admin->Nombre_1 }} {{ $admin->Apellido_1 }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Solo para tipos de usuario internos (Rescatista/Voluntario).</small>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label for="Password_user" class="form-label">Contraseña</label>
                                <input type="password" name="Password_user" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Password_user_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="Password_user_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Crear Usuario</button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection