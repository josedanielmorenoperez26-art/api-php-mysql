<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ingresos', function (Blueprint $table) {
            // Agregamos el campo después de categoria_id
            $table->foreignId('area_id')
                ->after('categoria_id')
                ->constrained('areas')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('ingresos', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
    }
};