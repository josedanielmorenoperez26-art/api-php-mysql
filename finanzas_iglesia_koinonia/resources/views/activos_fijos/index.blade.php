<x-app-layout>
    <div class="p-6">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800">📦 Activos Fijos</h1>
            <p class="text-gray-600">Control de bienes de la iglesia</p>
        </div>

        <div class="text-center mb-8">
            <a href="{{ route('activos_fijos.create') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700">+ Registrar Activo</a>
        </div>

        <!-- Tarjetas de Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
                <p class="text-blue-600 font-bold text-xl">Bs {{ number_format($totalValor, 2, ',', '.') }}</p>
                <p class="text-gray-500 text-sm">Valor Total de Compra</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
                <p class="text-green-600 font-bold text-xl">Bs {{ number_format($totalActual, 2, ',', '.') }}</p>
                <p class="text-gray-500 text-sm">Valor Actual (Depreciado)</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-amber-500">
                <p class="text-amber-600 font-bold text-xl">{{ $activos->total() }}</p>
                <p class="text-gray-500 text-sm">Cantidad de Activos</p>
            </div>
        </div>

        <!-- Lista de Activos -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-lg mb-4">Lista de Activos</h3>

            @if(session('success'))
                <div class="bg-green-50 text-green-700 p-3 rounded-lg mb-4">{{ session('success') }}</div>
            @endif

            @if($activos->isEmpty())
                <p class="text-center text-gray-500 py-8">No hay activos registrados aún.</p>
            @else
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200 text-left font-semibold text-gray-600">
                        <th class="pb-2">Nombre</th>
                        <th class="pb-2">Código</th>
                        <th class="pb-2">Categoría</th>
                        <th class="pb-2">Valor Compra</th>
                        <th class="pb-2">Valor Actual</th>
                        <th class="pb-2">Estado</th>
                        <th class="pb-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activos as $activo)
                    <tr class="border-b text-gray-700">
                        <td class="py-3 font-medium">{{ $activo->nombre }}</td>
                        <td>{{ $activo->codigo ?? '-' }}</td>
                        <td>{{ $activo->categoria ?? '-' }}</td>
                        <td>Bs {{ number_format($activo->valor_compra, 2, ',', '.') }}</td>
                        <td class="text-green-600 font-semibold">Bs {{ number_format($activo->valor_actual, 2, ',', '.') }}</td>
                        <td>
                            <span class="px-2 py-1 rounded text-sm font-medium
                                {{ $activo->estado == 'activo' ? 'bg-green-100 text-green-700' :
                                   ($activo->estado == 'dado de baja' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ ucfirst($activo->estado) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-1">
                                <a href="{{ route('activos_fijos.edit', $activo) }}" class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm hover:bg-blue-200">✏️</a>
                                <form action="{{ route('activos_fijos.destroy', $activo) }}" method="POST" onsubmit="return confirm('¿Eliminar este activo?')">
                                    @csrf @method('DELETE')
                                    <button class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm hover:bg-red-200">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6">
                {{ $activos->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>