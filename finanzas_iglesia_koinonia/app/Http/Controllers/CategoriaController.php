<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    // ✅ LISTA CON PESTAÑAS: Ingresos / Gastos
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede gestionar categorías.');
        }

        $tipo = $request->get('tipo', 'ingreso'); // Por defecto muestra Ingresos
        
        $categorias = Categoria::where('tipo', $tipo)
            ->orderBy('nombre', 'asc')
            ->paginate(10); // ✅ Mantenemos la paginación que ya tenías

        return view('categorias.index', compact('categorias', 'tipo'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede gestionar categorías.');
        }
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede gestionar categorías.');
        }

        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'tipo' => 'required|in:ingreso,gasto',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', '✅ Categoría registrada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede gestionar categorías.');
        }
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede gestionar categorías.');
        }

        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,'.$categoria->id,
            'tipo' => 'required|in:ingreso,gasto',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('success', '✅ Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if (!Auth::check() || Auth::user()->rol !== 'administrador') {
            abort(403, 'Solo el administrador puede gestionar categorías.');
        }
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', '✅ Categoría eliminada.');
    }
}