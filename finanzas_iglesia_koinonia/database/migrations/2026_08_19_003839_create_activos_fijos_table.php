<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activos_fijos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->nullable();
            $table->string('categoria')->nullable(); // Equipo, Mobiliario, Inmueble, etc.
            $table->decimal('valor_compra', 12, 2);
            $table->date('fecha_compra')->nullable();
            $table->integer('vida_util_meses')->nullable();
            $table->string('estado')->default('activo'); // activo, dado de baja, en reparación
            $table->text('ubicacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activos_fijos');
    }
};