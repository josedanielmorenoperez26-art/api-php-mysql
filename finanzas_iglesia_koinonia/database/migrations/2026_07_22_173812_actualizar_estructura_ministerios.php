<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ PRIMERO CREAMOS LA TABLA SI NO EXISTE
        if (!Schema::hasTable('ministerios')) {
            Schema::create('ministerios', function (Blueprint $table) {
                $table->id();
                $table->string('nombre')->unique();
                $table->text('descripcion')->nullable();
                $table->string('horario_reuniones')->nullable();
                $table->foreignId('lider_id')->nullable()->constrained('miembros')->onDelete('set null');
                $table->enum('estado', ['activo', 'inactivo'])->default('activo');
                $table->timestamps();
            });
        } else {
            // Si ya existe, solo agregamos los campos que falten
            Schema::table('ministerios', function (Blueprint $table) {
                if (!Schema::hasColumn('ministerios', 'horario_reuniones')) {
                    $table->string('horario_reuniones')->nullable()->after('descripcion');
                }
                if (!Schema::hasColumn('ministerios', 'lider_id')) {
                    $table->foreignId('lider_id')->nullable()->constrained('miembros')->onDelete('set null')->after('horario_reuniones');
                }
                if (!Schema::hasColumn('ministerios', 'estado')) {
                    $table->enum('estado', ['activo', 'inactivo'])->default('activo')->after('lider_id');
                }
            });
        }

        // ✅ Creamos la tabla de relación Miembro ↔ Ministerio
        if (!Schema::hasTable('miembro_ministerio')) {
            Schema::create('miembro_ministerio', function (Blueprint $table) {
                $table->id();
                $table->foreignId('miembro_id')->constrained()->onDelete('cascade');
                $table->foreignId('ministerio_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('miembro_ministerio');
        Schema::dropIfExists('ministerios');
    }
};