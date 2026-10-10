<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Categoria;
use App\Models\Miembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IngresoController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede acceder.');
        }

        $ingresos = Ingreso::with(['categoria', 'miembro'])->latest('fecha_hora')->paginate(10);
        return view('ingresos.index', compact('ingresos'));
    }

    public function create()
    {
        // ✅ NOMBRE CORRECTO: categoriasIngreso (para que la vista lo reconozca)
        $categoriasIngreso = Categoria::where('tipo', 'ingreso')->orderBy('nombre', 'asc')->get();
        $miembros = Miembro::orderBy('nombre', 'asc')->get();

        return view('ingresos.create', compact('categoriasIngreso', 'miembros'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede guardar.');
        }

        $request->validate([
            'categoria_id'  => 'required|exists:categorias,id',
            'miembro_id'    => 'nullable|exists:miembros,id',
            'descripcion'   => 'nullable|string|max:255',
            'monto'         => 'required|numeric|min:0',
            'fecha_hora'    => 'required|date',
        ]);

        Ingreso::create([
            'categoria_id'  => $request->categoria_id,
            'miembro_id'    => $request->miembro_id,
            'descripcion'   => $request->descripcion,
            'monto'         => $request->monto,
            'fecha_hora'    => $request->fecha_hora,
        ]);

        return redirect()->route('finanzas.index')->with('success', 'Ingreso guardado correctamente ✅');
    }

    public function edit(Ingreso $ingreso)
    {
        // ✅ Igual aquí: categoriasIngreso
        $categoriasIngreso = Categoria::where('tipo', 'ingreso')->orderBy('nombre', 'asc')->get();
        $miembros = Miembro::orderBy('nombre', 'asc')->get();

        return view('ingresos.edit', compact('ingreso', 'categoriasIngreso', 'miembros'));
    }

    public function update(Request $request, Ingreso $ingreso)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede actualizar.');
        }

        $request->validate([
            'categoria_id'  => 'required|exists:categorias,id',
            'miembro_id'    => 'nullable|exists:miembros,id',
            'descripcion'   => 'nullable|string|max:255',
            'monto'         => 'required|numeric|min:0',
            'fecha_hora'    => 'required|date',
        ]);

        $ingreso->update([
            'categoria_id'  => $request->categoria_id,
            'miembro_id'    => $request->miembro_id,
            'descripcion'   => $request->descripcion,
            'monto'         => $request->monto,
            'fecha_hora'    => $request->fecha_hora,
        ]);

        return redirect()->route('finanzas.index')->with('success', 'Ingreso actualizado ✅');
    }

    public function destroy(Ingreso $ingreso)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede eliminar.');
        }

        $ingreso->delete();

        return redirect()->route('finanzas.index')->with('success', 'Ingreso eliminado ✅');
    }
}