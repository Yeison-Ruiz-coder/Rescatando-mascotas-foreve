<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nombre' => 'Admin',
                'apellidos' => 'Principal',
                'email' => 'admin@sistema.com',
                'password' => Hash::make('admin123'),
                'tipo' => 'admin',
                'estado' => 'activo',
                'fecha_nacimiento' => '1990-01-15',
                'direccion' => 'Av. Principal 123',
                'telefono' => '123456789',
                'tipo_documento' => 'DNI',
                'numero_documento' => '12345678A',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'nombre' => 'María',
                'apellidos' => 'González Pérez',
                'email' => 'maria@email.com',
                'password' => Hash::make('usuario123'),
                'tipo' => 'user',
                'estado' => 'activo',
                'fecha_nacimiento' => '1995-05-20',
                'direccion' => 'Calle del Sol 45',
                'telefono' => '987654321',
                'tipo_documento' => 'DNI',
                'numero_documento' => '87654321B',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'nombre' => 'Veterinaria',
                'apellidos' => 'San Roque',
                'email' => 'contacto@veterinariasanroque.com',
                'password' => Hash::make('vet123'),
                'tipo' => 'veterinaria',
                'estado' => 'activo',
                'fecha_nacimiento' => null,
                'direccion' => 'Av. de la Salud 789',
                'telefono' => '555123456',
                'tipo_documento' => 'CIF',
                'numero_documento' => 'B12345678',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'nombre' => 'Fundación',
                'apellidos' => 'Huellas Felices',
                'email' => 'info@huellasfelices.org',
                'password' => Hash::make('fundacion123'),
                'tipo' => 'fundacion',
                'estado' => 'pendiente',
                'fecha_nacimiento' => '1985-03-10',
                'direccion' => 'Calle de la Esperanza 567',
                'telefono' => '666987654',
                'tipo_documento' => 'CIF',
                'numero_documento' => 'G87654321',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1
            ]
        ]);
    }
}
