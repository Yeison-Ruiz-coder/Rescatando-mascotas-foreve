<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            // Clientes (potenciales adoptantes)
            [
                'Nombre_1' => 'Juan',
                'Nombre_2' => 'David',
                'Apellido_1' => 'Pérez',
                'Apellido_2' => 'García',
                'Fecha_nacimiento' => '1992-11-25',
                'Direccion' => 'Calle 45 #23-12, Bogotá',
                'Telefono' => '3201234567',
                'Email' => 'juan.perez@email.com',
                'Password_user' => Hash::make('cliente123'),
                'tipo' => 'Cliente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Laura',
                'Nombre_2' => 'Camila',
                'Apellido_1' => 'Martínez',
                'Apellido_2' => 'Silva',
                'Fecha_nacimiento' => '1995-07-18',
                'Direccion' => 'Av. 68 #15-20, Bogotá',
                'Telefono' => '3152345678',
                'Email' => 'laura.martinez@email.com',
                'Password_user' => Hash::make('cliente123'),
                'tipo' => 'Cliente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Andrés',
                'Nombre_2' => 'Felipe',
                'Apellido_1' => 'Ramírez',
                'Apellido_2' => 'Díaz',
                'Fecha_nacimiento' => '1988-04-30',
                'Direccion' => 'Carrera 7 #40-55, Bogotá',
                'Telefono' => '3183456789',
                'Email' => 'andres.ramirez@email.com',
                'Password_user' => Hash::make('cliente123'),
                'tipo' => 'Cliente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Rescatistas
            [
                'Nombre_1' => 'Sofia',
                'Nombre_2' => 'Alejandra',
                'Apellido_1' => 'Castro',
                'Apellido_2' => 'Rojas',
                'Fecha_nacimiento' => '1991-09-12',
                'Direccion' => 'Calle 100 #15-60, Bogotá',
                'Telefono' => '3174567890',
                'Email' => 'sofia.castro@email.com',
                'Password_user' => Hash::make('rescatista123'),
                'tipo' => 'Rescatista',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Voluntarios
            [
                'Nombre_1' => 'David',
                'Nombre_2' => 'Esteban',
                'Apellido_1' => 'Moreno',
                'Apellido_2' => 'Vargas',
                'Fecha_nacimiento' => '1993-12-05',
                'Direccion' => 'Carrera 15 #88-35, Bogotá',
                'Telefono' => '3195678901',
                'Email' => 'david.moreno@email.com',
                'Password_user' => Hash::make('voluntario123'),
                'tipo' => 'Voluntario',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}