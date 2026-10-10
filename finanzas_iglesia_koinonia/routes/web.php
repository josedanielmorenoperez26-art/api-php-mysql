<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\MinisterioController;
use App\Http\Controllers\ActivoFijoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FinanzaController; // ✅ AGREGADO

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas - requieren inicio de sesión
Route::middleware('auth')->group(function () {
    // Panel Principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ GESTIÓN DE USUARIOS — SOLO ADMINISTRADOR
    Route::resource('usuarios', UsuarioController::class);

    // ✅ Vista principal de Finanzas — CORREGIDA
    Route::get('/finanzas', [FinanzaController::class, 'index'])->name('finanzas.index');

    // ✅ ACTIVOS FIJOS — RUTAS COMPLETAS
    Route::resource('activos-fijos', ActivoFijoController::class)->names([
        'index' => 'activos_fijos.index',
        'create' => 'activos_fijos.create',
        'store' => 'activos_fijos.store',
        'edit' => 'activos_fijos.edit',
        'update' => 'activos_fijos.update',
        'destroy' => 'activos_fijos.destroy',
    ]);

    // ✅ REPORTES — TODAS LAS RUTAS INCLUIDA LA MENSUAL
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/ingresos', [ReporteController::class, 'ingresos'])->name('reportes.ingresos');
    Route::get('/reportes/gastos', [ReporteController::class, 'gastos'])->name('reportes.gastos');
    Route::get('/reportes/activos', [ReporteController::class, 'activos'])->name('reportes.activos');
    Route::get('/reportes/mensual', [ReporteController::class, 'mensual'])->name('reportes.mensual');
    Route::get('/reportes/exportar-pdf', [ReporteController::class, 'exportarPDF'])->name('reportes.exportar-pdf');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ MÓDULO MINISTERIOS COMPLETO
    Route::resource('ministerios', MinisterioController::class);
    Route::get('/ministerios/{ministerio}/miembros', [MinisterioController::class, 'administrarMiembros'])->name('ministerios.miembros');
    Route::post('/ministerios/{ministerio}/agregar-miembro', [MinisterioController::class, 'agregarMiembro'])->name('ministerios.agregar-miembro');
    Route::delete('/ministerios/{ministerio}/quitar-miembro/{miembro}', [MinisterioController::class, 'quitarMiembro'])->name('ministerios.quitar-miembro');

    // Resto de módulos
    Route::resource('miembros', MiembroController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('ingresos', IngresoController::class);
    Route::resource('gastos', GastoController::class);
});

require __DIR__.'/auth.php';