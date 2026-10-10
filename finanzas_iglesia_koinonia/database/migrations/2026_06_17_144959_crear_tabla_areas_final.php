<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Áreas que usan en la iglesia
        DB::table('areas')->insert([
            ['nombre' => 'Caja General', 'descripcion' => 'Fondo principal de la iglesia'],
            ['nombre' => 'Escuela Dominical', 'descripcion' => 'Actividades para niños'],
            ['nombre' => 'Círculo de Oración', 'descripcion' => 'Fondo del grupo de oración'],
            ['nombre' => 'Grupo Juvenil', 'descripcion' => 'Jóvenes actuales'],
            ['nombre' => 'Jóvenes Antiguos', 'descripcion' => 'Ex integrantes del grupo']
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};