<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministradoresSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('administradores')->insert([
            [
                'Nombre_1' => 'María',
                'Nombre_2' => 'Fernanda',
                'Apellido_1' => 'Gómez',
                'Apellido_2' => 'López',
                'Fecha_nacimiento' => '1985-05-15',
                'Direccion' => 'Calle 123 #45-67, Bogotá',
                'Telefono' => '3001234567',
                'Email' => 'maria.gomez@fundacion.com',
                'Password_admin' => Hash::make('admin123'),
                'Sueldo_admin' => 3500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nombre_1' => 'Carlos',
                'Nombre_2' => 'Alberto',
                'Apellido_1' => 'Rodríguez',
                'Apellido_2' => 'Martínez',
                'Fecha_nacimiento' => '1990-08-22',
                'Direccion' => 'Av. Principal #89-10, Medellín',
                'Telefono' => '3102345678',
                'Email' => 'carlos.rodriguez@fundacion.com',
                'Password_admin' => Hash::make('admin123'),
                'Sueldo_admin' => 3200000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}