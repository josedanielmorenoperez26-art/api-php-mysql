<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ CORREO EXACTO DE TU CUENTA: gabrielconotiri@gmail.com
        User::updateOrCreate(
            ['email' => 'gabrielconotiri@gmail.com'],
            [
                'name' => 'Gabriel Conotiri Amutari',
                'rol' => 'administrador', // ⚠️ EXACTO: minúsculas, sin espacios
                'password' => bcrypt('12345678') // ⚠️ CAMBIA ESTO POR TU CONTRASEÑA REAL
            ]
        );
    }
}