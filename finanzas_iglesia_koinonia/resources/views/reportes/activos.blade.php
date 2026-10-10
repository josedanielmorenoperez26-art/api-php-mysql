<x-app-layout>
    <div class="p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">📦 Reporte de Activos Fijos</h1>
                <p class="text-gray-600">Inventario completo de bienes de la iglesia</p>
            </div>
            <a href="{{ route('reportes.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">← Volver</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
                <p class="text-green-600 font-bold text-xl">Bs {{ number_format($totalCompra, 2, ',', '.') }}</p>
                <p class="text-gray-500">Valor Total de Compra</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
                <p class="text-blue-600 font-bold text-xl">Bs {{ number_format($totalActual, 2, ',', '.') }}</p>
                <p class="text-gray-500">Valor Actual Total</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200 text-left font-semibold">
                        <th class="pb-3">Nombre</th>
                        <th class="pb-3">Código</th>
                        <th class="pb-3">Categoría</th>
                        <th class="pb-3">Valor Compra</th>
                        <th class="pb-3">Valor Actual</th>
                        <th class="pb-3">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activos as $a)
                    <tr class="border-b">
                        <td class="py-3 font-medium">{{ $a->nombre }}</td>
                        <td>{{ $a->codigo ?? '-' }}</td>
                        <td>{{ $a->categoria ?? '-' }}</td>
                        <td>Bs {{ number_format($a->valor_compra, 2, ',', '.') }}</td>
                        <td class="text-green-600">Bs {{ number_format($a->valor_actual, 2, ',', '.') }}</td>
                        <td>
                            <span class="px-2 py-1 rounded text-sm font-medium
                                {{ $a->estado == 'activo' ? 'bg-green-100 text-green-700' :
                                   ($a->estado == 'dado de baja' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ ucfirst($a->estado) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>