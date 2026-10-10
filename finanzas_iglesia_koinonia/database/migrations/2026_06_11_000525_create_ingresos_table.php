<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained();
            $table->foreignId('miembro_id')->nullable()->constrained(); // Quién entregó
            $table->decimal('monto', 10, 2);
            $table->decimal('deuda_pendiente', 10, 2)->default(0); // Control de deudas
            $table->enum('estado_pago', ['pagado', 'pendiente', 'parcial'])->default('pagado');
            $table->date('fecha');
            $table->string('numero_comprobante')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};