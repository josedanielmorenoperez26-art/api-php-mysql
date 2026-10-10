<?php

namespace App\Http\Controllers;

use App\Models\ActivoFijo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivoFijoController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede gestionar activos fijos.');
        }
        $activos = ActivoFijo::latest()->paginate(10);
        $totalValor = ActivoFijo::sum('valor_compra');
        $totalActual = ActivoFijo::get()->sum('valor_actual');
        return view('activos_fijos.index', compact('activos', 'totalValor', 'totalActual'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);
        return view('activos_fijos.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:100',
            'valor_compra' => 'required|numeric|min:0',
            'fecha_compra' => 'nullable|date',
            'vida_util_meses' => 'nullable|integer|min:1',
            'estado' => 'required|string',
            'ubicacion' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ]);

        ActivoFijo::create($request->all());
        return redirect()->route('activos_fijos.index')->with('success', 'Activo registrado correctamente.');
    }

    public function edit(ActivoFijo $activos_fijo)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);
        return view('activos_fijos.edit', compact('activos_fijo'));
    }

    public function update(Request $request, ActivoFijo $activos_fijo)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:100',
            'valor_compra' => 'required|numeric|min:0',
            'fecha_compra' => 'nullable|date',
            'vida_util_meses' => 'nullable|integer|min:1',
            'estado' => 'required|string',
            'ubicacion' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ]);
        $activos_fijo->update($request->all());
        return redirect()->route('activos_fijos.index')->with('success', 'Activo actualizado correctamente.');
    }

    public function destroy(ActivoFijo $activos_fijo)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') abort(403);
        $activos_fijo->delete();
        return redirect()->route('activos_fijos.index')->with('success', 'Activo eliminado.');
    }
}