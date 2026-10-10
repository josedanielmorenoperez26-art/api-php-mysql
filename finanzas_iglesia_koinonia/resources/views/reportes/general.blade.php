<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte General Acumulado') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold">IGLESIA CRISTIANA "KOINONÍA"</h3>
                    <h4 class="text-lg">RESUMEN FINANCIERO TOTAL</h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-5 bg-green-50 border-l-4 border-green-600 rounded">
                        <h5 class="text-lg font-semibold text-green-800">Total Ingresos</h5>
                        <p class="text-2xl font-bold">Bs. {{ number_format($totalIng, 2) }}</p>
                    </div>

                    <div class="p-5 bg-red-50 border-l-4 border-red-600 rounded">
                        <h5 class="text-lg font-semibold text-red-800">Total Gastos</h5>
                        <p class="text-2xl font-bold">Bs. {{ number_format($totalGas, 2) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="p-5 bg-blue-50 border-l-4 border-blue-600 rounded">
                        <h5 class="text-lg font-semibold text-blue-800">Saldo Actual</h5>
                        <p class="text-2xl font-bold">Bs. {{ number_format($saldo, 2) }}</p>
                    </div>

                    <div class="p-5 bg-amber-50 border-l-4 border-amber-600 rounded">
                        <h5 class="text-lg font-semibold text-amber-800">Deudas Pendientes</h5>
                        <p class="text-2xl font-bold">Bs. {{ number_format($deudas, 2) }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>