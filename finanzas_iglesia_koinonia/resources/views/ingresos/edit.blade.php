<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Ingreso
        </h2>
        <p class="text-gray-600">Modifique los datos del ingreso</p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('ingresos.update', $ingreso) }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Ingreso *</label>
                            <select name="categoria_id" required class="w-full border-gray-300 rounded-md shadow-sm text-lg p-2">
                                <option value="">-- Seleccione --</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}" {{ $ingreso->categoria_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">👤 Miembro (opcional)</label>
                            <select name="miembro_id" class="w-full border-gray-300 rounded-md shadow-sm text-lg p-2">
                                <option value="">-- Sin miembro --</option>
                                @foreach($miembros as $m)
                                    <option value="{{ $m->id }}" {{ $ingreso->miembro_id == $m->id ? 'selected' : '' }}>
                                        {{ $m->nombre }} {{ $m->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <input type="text" name="descripcion" value="{{ $ingreso->descripcion ?? '' }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm text-lg p-2">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Monto (Bs.) *</label>
                            <input type="number" step="0.01" name="monto" required value="{{ $ingreso->monto }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm text-lg p-2">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">📅 Fecha y Hora *</label>
                            <input type="datetime-local" name="fecha_hora" required value="{{ $ingreso->fecha_hora->format('Y-m-d\TH:i') }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm text-lg p-2">
                        </div>
                        
                        <div class="flex gap-3 pt-4">
                            <a href="{{ route('finanzas.index') }}" class="flex-1 py-3 text-center border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">
                                Cancelar
                            </a>
                            <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg">
                                Actualizar Ingreso
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>