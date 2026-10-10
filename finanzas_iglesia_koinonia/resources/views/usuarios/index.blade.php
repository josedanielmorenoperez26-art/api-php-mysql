<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👤 Gestionar Usuarios del Sistema
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- ✅ Mensaje de éxito -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ➕ Botón Crear Nuevo -->
            <div class="mb-4 text-right">
                <a href="{{ route('usuarios.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                    ➕ Crear Nuevo Usuario
                </a>
            </div>

            <!-- 📋 Tabla de Usuarios -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Nombre</th>
                            <th class="px-6 py-3 font-semibold">Correo</th>
                            <th class="px-6 py-3 font-semibold">Rol</th>
                            <th class="px-6 py-3 font-semibold text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($usuarios as $u)
                        <tr>
                            <td class="px-6 py-4">{{ $u->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $u->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full {{ $u->rol === 'administrador' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($u->rol) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('usuarios.edit', $u) }}" class="text-blue-600 hover:underline mr-3">✏️ Editar</a>
                                
                                <!-- ✅ BOTÓN ELIMINAR -->
                                <form method="POST" action="{{ route('usuarios.destroy', $u) }}" class="inline-block" onsubmit="return confirm('¿Seguro de eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</x-app-layout>