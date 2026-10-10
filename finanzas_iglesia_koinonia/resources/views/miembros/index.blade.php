<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Gestión de Miembros</h1>
                <p class="text-gray-600">Lista completa de la familia de la Iglesia Koinonia</p>
            </div>
            <a href="{{ route('miembros.create') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                ➕ Nuevo Miembro
            </a>
        </div>

        <!-- Tarjetas de Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl shadow">
                <p class="text-sm text-gray-500">Total Miembros</p>
                <h3 class="text-xl font-bold text-gray-800">{{ \App\Models\Miembro::count() }}</h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow">
                <p class="text-sm text-gray-500">Miembros Activos</p>
                <h3 class="text-xl font-bold text-green-600">{{ \App\Models\Miembro::where('estado', 'activo')->count() }}</h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow">
                <p class="text-sm text-gray-500">Nuevos este mes</p>
                <h3 class="text-xl font-bold text-blue-600">{{ \App\Models\Miembro::whereMonth('created_at', now()->month)->count() }}</h3>
            </div>
        </div>

        <!-- Tabla Completa -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-50 border-b border-blue-200">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-bold text-blue-800 uppercase">Nombre</th>
                            <th class="px-5 py-3 text-left text-xs font-bold text-blue-800 uppercase">Apellido</th>
                            <th class="px-5 py-3 text-left text-xs font-bold text-blue-800 uppercase">Teléfono</th>
                            <th class="px-5 py-3 text-left text-xs font-bold text-blue-800 uppercase">Fecha Nacimiento</th>
                            <th class="px-5 py-3 text-left text-xs font-bold text-blue-800 uppercase">Estado</th>
                            <th class="px-5 py-3 text-center text-xs font-bold text-blue-800 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($miembros as $miembro)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-5 py-4 font-semibold text-gray-800">
                                {{ $miembro->nombre ?? explode(' ', $miembro->nombre_completo ?? 'Sin nombre')[0] }}
                            </td>
                            <td class="px-5 py-4 font-semibold text-gray-800">
                                {{ $miembro->apellido ?? (strpos($miembro->nombre_completo, ' ') ? substr($miembro->nombre_completo, strpos($miembro->nombre_completo, ' ') + 1) : '—') }}
                            </td>
                            <td class="px-5 py-4 text-gray-700">{{ $miembro->telefono ?? 'Sin registro' }}</td>
                            <td class="px-5 py-4 text-gray-700">{{ $miembro->fecha_nacimiento ?? 'Sin registro' }}</td>
                            <td class="px-5 py-4">
                                @if($miembro->estado == 'activo')
                                    <span class="px-3 py-1.5 text-xs font-bold rounded-full bg-green-100 text-green-800 border border-green-300">✅ Activo</span>
                                @else
                                    <span class="px-3 py-1.5 text-xs font-bold rounded-full bg-gray-100 text-gray-700 border border-gray-300">⏸️ Inactivo</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 flex justify-center gap-3">
                                <a href="{{ route('miembros.edit', $miembro) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md text-sm font-bold hover:bg-yellow-600 shadow-md">✏️ Editar</a>
                                <form action="{{ route('miembros.destroy', $miembro) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este miembro? Esta acción no se puede deshacer.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-bold hover:bg-red-700 shadow-md">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $miembros->links() }}
            </div>
        </div>
    </div>
</x-app-layout>