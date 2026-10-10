<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Ingreso;
use App\Models\Gasto;
use App\Models\ActivoFijo;
use App\Models\Miembro;
use App\Models\Ministerio;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReporteController extends Controller
{
    // ✅ REPORTE PRINCIPAL - RESUMEN GENERAL
    public function index()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede ver reportes.');
        }

        $totalIngresos = Ingreso::sum('monto');
        $totalGastos = Gasto::sum('monto');
        $balance = $totalIngresos - $totalGastos;
        $totalActivos = ActivoFijo::sum('valor_compra');
        $cantidadMiembros = Miembro::count();
        $cantidadMinisterios = Ministerio::count();

        // ✅ CORREGIDO: fecha_hora
        $mesIngresos = Ingreso::whereMonth('fecha_hora', now()->month)->sum('monto');
        $mesGastos = Gasto::whereMonth('fecha_hora', now()->month)->sum('monto');

        return view('reportes.index', compact(
            'totalIngresos', 'totalGastos', 'balance', 'totalActivos',
            'cantidadMiembros', 'cantidadMinisterios', 'mesIngresos', 'mesGastos'
        ));
    }

    // ✅ REPORTE MENSUAL POR ÁREAS
    public function mensual(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);

        $mes = $request->mes ?? Carbon::now()->month;
        $anio = $request->anio ?? Carbon::now()->year;
        $areas = Area::orderBy('nombre', 'asc')->get();
        $datos = [];
        $totalIngresos = 0;
        $totalGastos = 0;

        foreach ($areas as $area) {
            $ingresos = Ingreso::where('area_fondo', $area->nombre)
                // ✅ CORREGIDO: fecha_hora
                ->whereMonth('fecha_hora', $mes)
                ->whereYear('fecha_hora', $anio)
                ->sum('monto');

            $gastos = Gasto::whereMonth('fecha_hora', $mes)
                ->whereYear('fecha_hora', $anio)
                ->sum('monto');

            $saldo = $ingresos - $gastos;
            $datos[] = [
                'area' => $area->nombre,
                'ingresos' => $ingresos,
                'gastos' => $gastos,
                'saldo' => $saldo
            ];
            $totalIngresos += $ingresos;
            $totalGastos += $gastos;
        }

        $saldoGeneral = $totalIngresos - $totalGastos;
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es', 'spanish');
        $nombreMes = ucfirst(strftime('%B', mktime(0, 0, 0, $mes, 1)));

        return view('reportes.mensual', compact(
            'datos', 'totalIngresos', 'totalGastos', 'saldoGeneral',
            'mes', 'anio', 'nombreMes'
        ));
    }

    // ✅ REPORTE DE INGRESOS POR FECHAS
    public function ingresos(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);

        $desde = $request->desde ?? Carbon::now()->startOfMonth();
        $hasta = $request->hasta ?? Carbon::now();

        // ✅ CORREGIDO: fecha_hora
        $ingresos = Ingreso::with('categoria')
            ->whereBetween('fecha_hora', [$desde, $hasta])
            ->orderBy('fecha_hora', 'desc')
            ->get();

        $total = $ingresos->sum('monto');

        return view('reportes.ingresos', compact('ingresos', 'total', 'desde', 'hasta'));
    }

    // ✅ REPORTE DE GASTOS POR FECHAS
    public function gastos(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);

        $desde = $request->desde ?? Carbon::now()->startOfMonth();
        $hasta = $request->hasta ?? Carbon::now();

        // ✅ CORREGIDO: fecha_hora
        $gastos = Gasto::with('categoria')
            ->whereBetween('fecha_hora', [$desde, $hasta])
            ->orderBy('fecha_hora', 'desc')
            ->get();

        $total = $gastos->sum('monto');

        return view('reportes.gastos', compact('gastos', 'total', 'desde', 'hasta'));
    }

    // ✅ REPORTE DE ACTIVOS FIJOS
    public function activos()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);

        $activos = ActivoFijo::orderBy('nombre', 'asc')->get();
        $totalCompra = $activos->sum('valor_compra');
        $totalActual = $activos->sum('valor_actual');

        return view('reportes.activos', compact('activos', 'totalCompra', 'totalActual'));
    }
}