<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Administrar Miembros</h1>
                <p class="text-gray-600">Ministerio: <strong>{{ $ministerio->nombre }}</strong></p>
            </div>
            <a href="{{ route('ministerios.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">← Volver a Ministerios</a>
        </div>

        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- MIEMBROS YA ASIGNADOS -->
                <div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Miembros del Ministerio ({{ $miembrosAsignados->count() }})</h3>
                    @if($miembrosAsignados->isEmpty())
                        <p class="text-gray-500 italic">Aún no hay miembros asignados.</p>
                    @else
                        <div class="space-y-2">
                            @foreach($miembrosAsignados as $m)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="font-medium">{{ $m->nombre_completo }}</span>
                                <form action="{{ route('ministerios.quitar-miembro', [$ministerio, $m]) }}" method="POST" onsubmit="return confirm('¿Quitar a este miembro del ministerio?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xl">✕</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- AGREGAR NUEVO MIEMBRO -->
                <div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Añadir Miembro</h3>
                    <form action="{{ route('ministerios.agregar-miembro', $ministerio) }}" method="POST" class="space-y-3">
                        @csrf
                        <select name="miembro_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Selecciona un miembro --</option>
                            @foreach($miembrosDisponibles as $m)
                            <option value="{{ $m->id }}">{{ $m->nombre_completo }}</option>
                            @endforeach
                        </select>
                        @error('miembro_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                        <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">➕ Añadir al Ministerio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>