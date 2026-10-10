<x-app-layout>
    <x-slot name="header">{{ __('Cumpleañeros del Mes') }}</x-slot>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Mes actual: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h2>

                @if($cumpleaneros->isNotEmpty())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-sky-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nombre Completo</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Día y Mes</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Edad</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cumpleaneros as $miembro)
                        <tr>
                            <!-- ✅ AQUÍ ESTABA EL FALLO: AGREGAMOS EL NOMBRE -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{ $miembro->nombre_completo }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ \Carbon\Carbon::parse($miembro->fecha_nacimiento)->translatedFormat('d F') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ \Carbon\Carbon::parse($miembro->fecha_nacimiento)->age }} años
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ $miembro->telefono ?? 'No registrado' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center py-8 text-gray-500">
                    😊 No hay miembros que cumplan años este mes.
                </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('miembros.index') }}" class="text-blue-600 hover:text-blue-800">← Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>