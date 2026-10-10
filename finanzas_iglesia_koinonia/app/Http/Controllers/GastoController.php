<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GastoController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede acceder.');
        }

        $gastos = Gasto::with(['categoria'])->latest('fecha_hora')->paginate(10);
        return view('gastos.index', compact('gastos'));
    }

    public function create()
    {
        // ✅ NOMBRE CORRECTO: categoriasGasto
        $categoriasGasto = Categoria::where('tipo', 'gasto')->orderBy('nombre', 'asc')->get();
        return view('gastos.create', compact('categoriasGasto'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede guardar.');
        }

        $request->validate([
            'categoria_id'  => 'required|exists:categorias,id',
            'descripcion'   => 'nullable|string|max:255',
            'comprobante'   => 'nullable|string|max:255',
            'monto'         => 'required|numeric|min:0',
            'fecha_hora'    => 'required|date',
        ]);

        Gasto::create([
            'categoria_id'  => $request->categoria_id,
            'descripcion'   => $request->descripcion,
            'comprobante'   => $request->comprobante,
            'monto'         => $request->monto,
            'fecha_hora'    => $request->fecha_hora,
        ]);

        return redirect()->route('finanzas.index')->with('success', 'Gasto guardado correctamente ✅');
    }

    public function edit(Gasto $gasto)
    {
        // ✅ Igual aquí: categoriasGasto
        $categoriasGasto = Categoria::where('tipo', 'gasto')->orderBy('nombre', 'asc')->get();
        return view('gastos.edit', compact('gasto', 'categoriasGasto'));
    }

    public function update(Request $request, Gasto $gasto)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede actualizar.');
        }

        $request->validate([
            'categoria_id'  => 'required|exists:categorias,id',
            'descripcion'   => 'nullable|string|max:255',
            'comprobante'   => 'nullable|string|max:255',
            'monto'         => 'required|numeric|min:0',
            'fecha_hora'    => 'required|date',
        ]);

        $gasto->update([
            'categoria_id'  => $request->categoria_id,
            'descripcion'   => $request->descripcion,
            'comprobante'   => $request->comprobante,
            'monto'         => $request->monto,
            'fecha_hora'    => $request->fecha_hora,
        ]);

        return redirect()->route('finanzas.index')->with('success', 'Gasto actualizado ✅');
    }

    public function destroy(Gasto $gasto)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede eliminar.');
        }

        $gasto->delete();

        return redirect()->route('finanzas.index')->with('success', 'Gasto eliminado ✅');
    }
}