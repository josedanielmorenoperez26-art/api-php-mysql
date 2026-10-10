<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Gasto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FinanzaController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede acceder.');
        }

        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        // ✅ TOTALES GENERALES DE INGRESOS
        $totalIngresos = Ingreso::sum('monto');
        $ingresosMes = Ingreso::whereMonth('fecha_hora', $mesActual)->whereYear('fecha_hora', $anioActual)->sum('monto');

        // ✅ DIEZMO Y OFRENDA SEPARADOS — BUSCA POR NOMBRE EN CATEGORÍAS
        $catDiezmo = Categoria::where('nombre', 'like', '%Diezmo%')->first();
        $catOfrenda = Categoria::where('nombre', 'like', '%Ofrenda%')->first();
        
        $totalDiezmo = $catDiezmo ? Ingreso::where('categoria_id', $catDiezmo->id)->sum('monto') : 0;
        $totalOfrenda = $catOfrenda ? Ingreso::where('categoria_id', $catOfrenda->id)->sum('monto') : 0;

        // ✅ TOTALES DE GASTOS
        $totalGastos = Gasto::sum('monto');
        $cantidadGastos = Gasto::count();
        $gastosMes = Gasto::whereMonth('fecha_hora', $mesActual)->whereYear('fecha_hora', $anioActual)->sum('monto');

        // ✅ MESES CON GASTOS Y PROMEDIO
        $mesesConGastos = Gasto::selectRaw('MONTH(fecha_hora) as mes, YEAR(fecha_hora) as anio')
            ->distinct()
            ->count();
        $promedioGastos = $mesesConGastos > 0 ? $totalGastos / $mesesConGastos : 0;

        // ✅ LISTAS PARA TABLAS
        $ingresos = Ingreso::with(['categoria', 'miembro'])->latest('fecha_hora')->paginate(10);
        $gastos = Gasto::with(['categoria'])->latest('fecha_hora')->paginate(10);

        return view('finanzas.index', compact(
            'totalIngresos', 'ingresosMes', 'totalDiezmo', 'totalOfrenda',
            'totalGastos', 'cantidadGastos', 'mesesConGastos', 'promedioGastos',
            'ingresos', 'gastos'
        ));
    }
}