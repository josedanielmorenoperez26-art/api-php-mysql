<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 🟢 TABLA INGRESOS — solo agregamos lo que FALTA
        Schema::table('ingresos', function (Blueprint $table) {
            if (!Schema::hasColumn('ingresos', 'fecha_hora')) {
                $table->dateTime('fecha_hora')->useCurrent();
            }
            if (!Schema::hasColumn('ingresos', 'comprobante')) {
                $table->string('comprobante')->nullable();
            }
            if (!Schema::hasColumn('ingresos', 'descripcion')) {
                $table->text('descripcion')->nullable();
            }
            // Si miembro_id ya existe, NO lo volvemos a crear
            if (!Schema::hasColumn('ingresos', 'miembro_id')) {
                $table->unsignedBigInteger('miembro_id')->nullable();
                $table->foreign('miembro_id')->references('id')->on('miembros')->onDelete('set null');
            }
        });

        // 🔴 TABLA GASTOS — solo agregamos lo que FALTA
        Schema::table('gastos', function (Blueprint $table) {
            if (!Schema::hasColumn('gastos', 'fecha_hora')) {
                $table->dateTime('fecha_hora')->useCurrent();
            }
            if (!Schema::hasColumn('gastos', 'comprobante')) {
                $table->string('comprobante')->nullable();
            }
            if (!Schema::hasColumn('gastos', 'descripcion')) {
                $table->text('descripcion')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('ingresos', function (Blueprint $table) {
            if (Schema::hasColumn('ingresos', 'fecha_hora')) {
                $table->dropColumn('fecha_hora');
            }
            if (Schema::hasColumn('ingresos', 'comprobante')) {
                $table->dropColumn('comprobante');
            }
            if (Schema::hasColumn('ingresos', 'descripcion')) {
                $table->dropColumn('descripcion');
            }
            if (Schema::hasColumn('ingresos', 'miembro_id')) {
                $table->dropForeign(['miembro_id']);
                $table->dropColumn('miembro_id');
            }
        });

        Schema::table('gastos', function (Blueprint $table) {
            if (Schema::hasColumn('gastos', 'fecha_hora')) {
                $table->dropColumn('fecha_hora');
            }
            if (Schema::hasColumn('gastos', 'comprobante')) {
                $table->dropColumn('comprobante');
            }
            if (Schema::hasColumn('gastos', 'descripcion')) {
                $table->dropColumn('descripcion');
            }
        });
    }
};