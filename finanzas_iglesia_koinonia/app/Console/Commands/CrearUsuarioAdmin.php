<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CrearUsuarioAdmin extends Command
{
    protected $signature = 'usuario:crear';
    protected $description = 'Crea un usuario administrador';

    public function handle()
    {
        $usuario = User::create([
            'name' => 'Gabriel Conotiri',
            'email' => 'gabrielconotiri@gmail.com',
            'password' => Hash::make('12345678'), // Pon aquí tu contraseña
            'rol' => 'administrador'
        ]);

        $this->info('✅ Usuario creado correctamente:');
        $this->info('Correo: gabrielconotiri@gmail.com');
        $this->info('Contraseña: 12345678');
        return 0;
    }
}