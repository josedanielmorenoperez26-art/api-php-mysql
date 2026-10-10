<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('miembros', function (Blueprint $table) {
            // Separamos nombre y apellido
            $table->string('nombre')->after('id');
            $table->string('apellido')->after('nombre');
            // Agregamos campo de estado
            $table->enum('estado', ['activo', 'inactivo'])->default('activo')->after('fecha_nacimiento');
            // Mantenemos nombre_completo temporalmente o lo dejamos si prefieres
        });
    }

    public function down(): void
    {
        Schema::table('miembros', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'apellido', 'estado']);
        });
    }
};