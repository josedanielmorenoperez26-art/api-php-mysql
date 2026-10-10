<x-app-layout>
    <div class="p-6">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800">📊 Reportes del Sistema</h1>
            <p class="text-gray-600">Resumen general de la Iglesia Koinonia</p>
        </div>

        <!-- Tarjetas de Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-green-500">
                <p class="text-green-600 font-bold text-lg">Bs {{ number_format($totalIngresos, 2, ',', '.') }}</p>
                <p class="text-gray-500 text-sm">Ingresos Totales</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-red-500">
                <p class="text-red-600 font-bold text-lg">Bs {{ number_format($totalGastos, 2, ',', '.') }}</p>
                <p class="text-gray-500 text-sm">Gastos Totales</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-blue-500">
                <p class="text-blue-600 font-bold text-lg">Bs {{ number_format($balance, 2, ',', '.') }}</p>
                <p class="text-gray-500 text-sm">Balance Neto</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-amber-500">
                <p class="text-amber-600 font-bold text-lg">Bs {{ number_format($totalActivos, 2, ',', '.') }}</p>
                <p class="text-gray-500 text-sm">Activos Fijos</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-teal-500">
                <p class="text-teal-600 font-bold text-lg">{{ $cantidadMiembros }}</p>
                <p class="text-gray-500 text-sm">Miembros</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-purple-500">
                <p class="text-purple-600 font-bold text-lg">{{ $cantidadMinisterios }}</p>
                <p class="text-gray-500 text-sm">Ministerios</p>
            </div>
        </div>

        <!-- Botones de Reportes -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('reportes.ingresos') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-green-600 mb-2">💰 Reporte de Ingresos</h3>
                <p class="text-gray-600">Ver todos los ingresos por fechas y categorías</p>
            </a>
            <a href="{{ route('reportes.gastos') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-red-600 mb-2">📉 Reporte de Gastos</h3>
                <p class="text-gray-600">Ver todos los gastos por fechas y categorías</p>
            </a>
            <a href="{{ route('reportes.activos') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-amber-600 mb-2">📦 Reporte de Activos</h3>
                <p class="text-gray-600">Inventario completo de activos fijos</p>
            </a>
        </div>

        <!-- Resumen del Mes Actual -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-lg mb-4">📅 Este Mes ({{ now()->format('F Y') }})</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border-l-4 border-green-500 pl-4">
                    <p class="text-gray-500">Ingresos del Mes</p>
                    <p class="text-2xl font-bold text-green-600">Bs {{ number_format($mesIngresos, 2, ',', '.') }}</p>
                </div>
                <div class="border-l-4 border-red-500 pl-4">
                    <p class="text-gray-500">Gastos del Mes</p>
                    <p class="text-2xl font-bold text-red-600">Bs {{ number_format($mesGastos, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>