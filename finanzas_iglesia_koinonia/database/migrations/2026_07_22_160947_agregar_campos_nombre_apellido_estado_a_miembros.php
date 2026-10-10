<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('miembros', function (Blueprint $table) {
            if (!Schema::hasColumn('miembros', 'nombre')) {
                $table->string('nombre')->after('id');
            }
            if (!Schema::hasColumn('miembros', 'apellido')) {
                $table->string('apellido')->after('nombre');
            }
            if (!Schema::hasColumn('miembros', 'estado')) {
                $table->enum('estado', ['activo', 'inactivo'])->default('activo')->after('fecha_nacimiento');
            }
            // ✅ Hacemos que nombre_completo permita valor nulo
            $table->string('nombre_completo')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('miembros', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'apellido', 'estado']);
            $table->string('nombre_completo')->nullable(false)->change();
        });
    }
};