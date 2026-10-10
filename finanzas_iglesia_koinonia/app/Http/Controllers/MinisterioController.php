<?php

namespace App\Http\Controllers;

use App\Models\Ministerio;
use App\Models\Miembro;
use Illuminate\Http\Request;

// ✅ ASEGURAMOS QUE HEREDE DE LA CLASE BASE Controller
class MinisterioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->rol !== 'administrador') {
                abort(403, 'Solo administradores pueden gestionar ministerios');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $soloActivos = $request->get('solo_activos', false);
        $buscar = $request->get('buscar', '');

        $ministerios = Ministerio::with(['lider', 'miembros'])
            ->when($soloActivos, fn($q) => $q->where('estado', 'activo'))
            ->when($buscar, fn($q) => $q->where('nombre', 'LIKE', "%{$buscar}%"))
            ->orderBy('nombre', 'asc')
            ->get();

        $totalParticipantes = Ministerio::with('miembros')->get()->sum('cantidad_participantes');

        return view('ministerios.index', compact('ministerios', 'soloActivos', 'buscar', 'totalParticipantes'));
    }

    public function create()
    {
        $miembros = Miembro::where('estado', 'activo')->orderBy('nombre_completo', 'asc')->get();
        return view('ministerios.create', compact('miembros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:ministerios,nombre',
            'descripcion' => 'nullable|string',
            'horario_reuniones' => 'nullable|string|max:255',
            'lider_id' => 'nullable|exists:miembros,id',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Ministerio::create($validated);
        return redirect()->route('ministerios.index')->with('success', 'Ministerio registrado correctamente.');
    }

    public function edit(Ministerio $ministerio)
    {
        $miembros = Miembro::where('estado', 'activo')->orderBy('nombre_completo', 'asc')->get();
        return view('ministerios.edit', compact('ministerio', 'miembros'));
    }

    public function update(Request $request, Ministerio $ministerio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:ministerios,nombre,'.$ministerio->id,
            'descripcion' => 'nullable|string',
            'horario_reuniones' => 'nullable|string|max:255',
            'lider_id' => 'nullable|exists:miembros,id',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $ministerio->update($validated);
        return redirect()->route('ministerios.index')->with('success', 'Ministerio actualizado correctamente.');
    }

    public function administrarMiembros(Ministerio $ministerio)
    {
        $miembrosDisponibles = Miembro::where('estado', 'activo')
            ->whereDoesntHave('ministerios', fn($q) => $q->where('ministerio_id', $ministerio->id))
            ->orderBy('nombre_completo', 'asc')
            ->get();

        $miembrosAsignados = $ministerio->miembros;

        return view('ministerios.miembros', compact('ministerio', 'miembrosDisponibles', 'miembrosAsignados'));
    }

    public function agregarMiembro(Request $request, Ministerio $ministerio)
    {
        $request->validate([
            'miembro_id' => 'required|exists:miembros,id',
        ]);

        $ministerio->miembros()->syncWithoutDetaching([$request->miembro_id]);
        return back()->with('success', 'Miembro agregado al ministerio.');
    }

    public function quitarMiembro(Ministerio $ministerio, Miembro $miembro)
    {
        $ministerio->miembros()->detach($miembro->id);
        return back()->with('success', 'Miembro retirado del ministerio.');
    }

    public function destroy(Ministerio $ministerio)
    {
        $ministerio->miembros()->detach();
        $ministerio->delete();
        return redirect()->route('ministerios.index')->with('success', 'Ministerio eliminado correctamente.');
    }
}