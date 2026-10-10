<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Saltamos completamente esta migración antigua que intenta borrar la tabla
        return;
    }

    public function down(): void
    {
        // ✅ También saltamos la reversión
        return;
    }
};