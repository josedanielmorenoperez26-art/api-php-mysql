<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained();
            $table->decimal('monto', 10, 2);
            $table->decimal('deuda_pendiente', 10, 2)->default(0);
            $table->enum('estado_pago', ['pagado', 'pendiente', 'parcial'])->default('pagado');
            $table->string('acreedor')->nullable(); // A quién se le debe
            $table->date('fecha');
            $table->string('numero_comprobante')->nullable();
            $table->text('descripcion'); // Motivo del gasto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};