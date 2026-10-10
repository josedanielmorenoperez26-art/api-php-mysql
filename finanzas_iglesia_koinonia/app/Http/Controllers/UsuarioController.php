<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    // ✅ Solo administrador puede acceder
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->rol !== 'administrador') {
                abort(403, 'Solo el administrador puede gestionar usuarios.');
            }
            return $next($request);
        });
    }

    // 📋 Listar todos los usuarios
    public function index()
    {
        $usuarios = User::orderBy('id', 'desc')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    // ➕ Mostrar formulario para crear
    public function create()
    {
        return view('usuarios.create');
    }

    // 💾 Guardar usuario nuevo
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'required|in:administrador,secretario',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', '✅ Usuario creado correctamente.');
    }

    // ✏️ Mostrar formulario para editar
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    // 🔄 Actualizar usuario
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'rol' => 'required|in:administrador,secretario',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $datos = [
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
        ];

        // ✅ Solo cambia contraseña si se escribió una nueva
        if ($request->password) {
            $datos['password'] = Hash::make($request->password);
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')->with('success', '✅ Usuario actualizado correctamente.');
    }

    // 🗑️ ELIMINAR USUARIO — ✅ AGREGADO
    public function destroy(User $usuario)
    {
        // ✅ Protección: No puedes borrarte a ti mismo
        if ($usuario->id === Auth::id()) {
            return redirect()->route('usuarios.index')->with('error', '❌ No puedes eliminar tu propia cuenta.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', '✅ Usuario eliminado correctamente.');
    }
}