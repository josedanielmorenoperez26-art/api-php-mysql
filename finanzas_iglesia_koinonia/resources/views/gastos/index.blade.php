<x-app-layout>
    <x-slot name="header">{{ __('Lista de Gastos') }}</x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            <div class="flex justify-end mb-4">
                <a href="{{ route('gastos.create') }}" class="btn btn-primary">+ Nuevo Gasto</a>
            </div>
            <div class="bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Área / Fondo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Monto (Bs)</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($gastos as $gasto)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $gasto->categoria->nombre ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $gasto->area->nombre ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">{{ $gasto->descripcion ?? 'Sin descripción' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">{{ number_format($gasto->monto, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <a href="{{ route('gastos.edit', $gasto) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Editar</a>
                                <form action="{{ route('gastos.destroy', $gasto) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este gasto?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Aún no hay gastos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-4 py-3">{{ $gastos->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>