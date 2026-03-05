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
                'apellidos' => 'Sistema',
                'email' => 'admin@test.com',
                'password' => Hash::make('12345678'),
                'tipo' => 'admin',
                'estado' => 'activo',
                'telefono' => '3000000001',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Juan',
                'apellidos' => 'Pérez',
                'email' => 'user@test.com',
                'password' => Hash::make('12345678'),
                'tipo' => 'user',
                'estado' => 'activo',
                'telefono' => '3000000002',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Clinica',
                'apellidos' => 'Veterinaria',
                'email' => 'vet@test.com',
                'password' => Hash::make('12345678'),
                'tipo' => 'veterinaria',
                'estado' => 'activo',
                'telefono' => '3000000003',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Fundacion',
                'apellidos' => 'Mascotas',
                'email' => 'fundacion@test.com',
                'password' => Hash::make('12345678'),
                'tipo' => 'fundacion',
                'estado' => 'activo',
                'telefono' => '3000000004',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
