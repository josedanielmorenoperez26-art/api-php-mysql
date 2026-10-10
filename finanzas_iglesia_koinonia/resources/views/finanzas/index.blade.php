<x-app-layout>
    <!-- ✅ TÍTULO — FONDO AZUL OSCURO IGUAL AL MENÚ, LETRAS BLANCAS -->
    <div class="bg-blue-800 py-6 px-6 -mt-6 -mx-6 mb-6 shadow-lg border-b-3 border-yellow-500">
        <h2 class="text-3xl font-extrabold text-white flex items-center gap-3">
            🏛️ FINANZAS — IGLESIA KOINONIA
        </h2>
        <p class="text-blue-200 text-base mt-2">
            📊 Registro y control de ingresos y egresos
        </p>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ✅ BOTONES ARRIBA -->
            <div class="flex gap-4 mb-6">
                <a href="{{ route('ingresos.create') }}" class="flex-1 text-center py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-lg shadow-md transition border-2 border-green-700">
                    ➕ Nuevo Ingreso
                </a>
                <a href="{{ route('gastos.create') }}" class="flex-1 text-center py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-lg shadow-md transition border-2 border-red-700">
                    ➕ Nuevo Gasto
                </a>
            </div>

            <!-- ✅ INGRESOS Y GASTOS LADO A LADO -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                <!-- 🟩 INGRESOS -->
                <div>
                    <h3 class="text-xl font-bold text-green-700 mb-4 flex items-center gap-2 border-b-2 border-green-500 pb-2">
                        📈 INGRESOS
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-green-50 rounded-xl shadow p-4 border-t-4 border-green-500">
                            <p class="text-sm text-gray-600">Total Ingresos</p>
                            <p class="text-2xl font-bold text-green-700 mt-1">Bs. {{ number_format($totalIngresos ?? 0, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-green-50 rounded-xl shadow p-4 border-t-4 border-green-500">
                            <p class="text-sm text-gray-600">🔟 Total Diezmo</p>
                            <p class="text-2xl font-bold text-green-700 mt-1">Bs. {{ number_format($totalDiezmo ?? 0, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-green-50 rounded-xl shadow p-4 border-t-4 border-green-500">
                            <p class="text-sm text-gray-600">🕊️ Total Ofrenda</p>
                            <p class="text-2xl font-bold text-green-700 mt-1">Bs. {{ number_format($totalOfrenda ?? 0, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-green-50 rounded-xl shadow p-4 border-t-4 border-green-500">
                            <p class="text-sm text-gray-600">Ingresos este Mes</p>
                            <p class="text-2xl font-bold text-green-700 mt-1">Bs. {{ number_format($ingresosMes ?? 0, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- 🟥 GASTOS -->
                <div>
                    <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center gap-2 border-b-2 border-red-500 pb-2">
                        📉 GASTOS / EGRESOS
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-red-50 rounded-xl shadow p-4 border-t-4 border-red-500">
                            <p class="text-sm text-gray-600">Total Egresos</p>
                            <p class="text-2xl font-bold text-red-700 mt-1">{{ $cantidadGastos ?? 0 }}</p>
                        </div>
                        <div class="bg-red-50 rounded-xl shadow p-4 border-t-4 border-red-500">
                            <p class="text-sm text-gray-600">Total Gastado</p>
                            <p class="text-2xl font-bold text-red-700 mt-1">Bs. {{ number_format($totalGastos ?? 0, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-50 rounded-xl shadow p-4 border-t-4 border-red-500">
                            <p class="text-sm text-gray-600">Meses con Gastos</p>
                            <p class="text-2xl font-bold text-gray-700 mt-1">{{ $mesesConGastos ?? 0 }}</p>
                        </div>
                        <div class="bg-red-50 rounded-xl shadow p-4 border-t-4 border-red-500">
                            <p class="text-sm text-gray-600">Promedio Mensual</p>
                            <p class="text-2xl font-bold text-red-700 mt-1">Bs. {{ number_format($promedioGastos ?? 0, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ✅ SALDO ACTUAL — AZUL OSCURO IGUAL AL MENÚ, LETRAS BLANCAS -->
            <div class="bg-blue-800 rounded-xl shadow-lg p-6 mb-8 text-center border-2 border-yellow-500">
                <p class="text-blue-200 font-semibold text-lg mb-2">💰 SALDO ACTUAL (Ingresos − Gastos)</p>
                <p class="text-4xl font-extrabold text-white">Bs. {{ number_format(($totalIngresos ?? 0) - ($totalGastos ?? 0), 2, ',', '.') }}</p>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border-l-4 border-green-500">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- ✅ TABLA INGRESOS -->
            <div class="bg-white rounded-xl shadow p-6 mb-6 border-t-4 border-green-500">
                <h4 class="font-bold text-gray-800 mb-4 text-lg flex items-center gap-2">📋 Ingresos Registrados</h4>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-green-50">
                            <tr class="text-left font-semibold text-green-800">
                                <th class="px-4 py-3">Fecha y Hora</th>
                                <th class="px-4 py-3">Categoría</th>
                                <th class="px-4 py-3">Miembro</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3 text-right">Monto</th>
                                <th class="px-4 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingresos as $i)
                            <tr class="border-t hover:bg-green-50">
                                <td class="px-4 py-3">{{ $i->fecha_hora->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 font-medium">{{ $i->categoria->nombre }}</td>
                                <td class="px-4 py-3">{{ $i->miembro?->nombre . ' ' . $i->miembro?->apellido ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $i->descripcion ?? '-' }}</td>
                                <td class="px-4 py-3 text-right font-bold">Bs. {{ number_format($i->monto, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('ingresos.edit', $i) }}" class="text-blue-600 font-medium mr-2">✏️ Editar</a>
                                    <form action="{{ route('ingresos.destroy', $i) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este ingreso?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 font-medium">🗑️ Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ✅ TABLA GASTOS -->
            <div class="bg-white rounded-xl shadow p-6 border-t-4 border-red-500">
                <h4 class="font-bold text-gray-800 mb-4 text-lg flex items-center gap-2">📋 Gastos / Egresos Registrados</h4>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-red-50">
                            <tr class="text-left font-semibold text-red-800">
                                <th class="px-4 py-3">Fecha y Hora</th>
                                <th class="px-4 py-3">Categoría</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Comprobante</th>
                                <th class="px-4 py-3 text-right">Monto</th>
                                <th class="px-4 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gastos as $g)
                            <tr class="border-t hover:bg-red-50">
                                <td class="px-4 py-3">{{ $g->fecha_hora->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 font-medium">{{ $g->categoria->nombre }}</td>
                                <td class="px-4 py-3">{{ $g->descripcion ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $g->comprobante ?? '-' }}</td>
                                <td class="px-4 py-3 text-right font-bold">Bs. {{ number_format($g->monto, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('gastos.edit', $g) }}" class="text-blue-600 font-medium mr-2">✏️ Editar</a>
                                    <form action="{{ route('gastos.destroy', $g) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este gasto?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 font-medium">🗑️ Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>