<x-app-layout>
    <div class="p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">💰 Reporte de Ingresos</h1>
                <p class="text-gray-600">Desde {{ \Carbon\Carbon::parse($desde)->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse($hasta)->format('d/m/Y') }}</p>
            </div>
            <a href="{{ route('reportes.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">← Volver</a>
        </div>

        <!-- Filtro de Fechas -->
        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <form method="GET" class="flex gap-4 items-center flex-wrap">
                <div>
                    <label class="block text-sm font-medium mb-1">Desde</label>
                    <input type="date" name="desde" value="{{ $desde }}" class="border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Hasta</label>
                    <input type="date" name="hasta" value="{{ $hasta }}" class="border rounded p-2">
                </div>
                <div class="pt-5">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Filtrar</button>
                </div>
            </form>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-xl shadow p-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200 text-left font-semibold">
                        <th class="pb-3">Fecha</th>
                        <th class="pb-3">Categoría</th>
                        <th class="pb-3">Descripción</th>
                        <th class="pb-3 text-right">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingresos as $i)
                    <tr class="border-b">
                        <td class="py-3">{{ \Carbon\Carbon::parse($i->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $i->categoria?->nombre ?? '-' }}</td>
                        <td>{{ $i->descripcion }}</td>
                        <td class="py-3 text-right font-semibold text-green-600">Bs {{ number_format($i->monto, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr class="font-bold text-lg">
                        <td colspan="3" class="py-3">TOTAL</td>
                        <td class="py-3 text-right text-green-700">Bs {{ number_format($total, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>