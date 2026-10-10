<?php

namespace App\Http\Controllers;

use App\Models\Miembro;
use Illuminate\Http\Request;

class MiembroController extends Controller
{
    public function index()
    {
        $miembros = Miembro::orderBy('nombre_completo', 'asc')->paginate(10);
        return view('miembros.index', compact('miembros'));
    }

    public function create()
    {
        return view('miembros.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
        ]);

        // ✅ Generamos y aseguramos el valor de nombre_completo
        $validated['nombre_completo'] = trim($validated['nombre'] . ' ' . $validated['apellido']);

        Miembro::create($validated);

        return redirect()->route('miembros.index')->with('success', 'Miembro registrado correctamente.');
    }

    public function show(Miembro $miembro)
    {
        return view('miembros.show', compact('miembro'));
    }

    public function edit(Miembro $miembro)
    {
        return view('miembros.edit', compact('miembro'));
    }

    public function update(Request $request, Miembro $miembro)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
        ]);

        // ✅ Actualizamos nombre_completo automáticamente
        $validated['nombre_completo'] = trim($validated['nombre'] . ' ' . $validated['apellido']);

        $miembro->update($validated);

        return redirect()->route('miembros.index')->with('success', 'Datos actualizados correctamente.');
    }

    public function destroy(Miembro $miembro)
    {
        $miembro->delete();
        return redirect()->route('miembros.index')->with('success', 'Miembro eliminado correctamente.');
    }
}