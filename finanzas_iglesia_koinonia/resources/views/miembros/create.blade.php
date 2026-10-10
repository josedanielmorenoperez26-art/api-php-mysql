<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ isset($miembro) ? 'Editar Miembro' : 'Registrar Nuevo Miembro' }}</h1>
            <p class="text-gray-600">Completa los datos del miembro de la iglesia</p>
        </div>

        <div class="max-w-2xl bg-white rounded-xl shadow p-6">
            <form action="{{ isset($miembro) ? route('miembros.update', $miembro) : route('miembros.store') }}" method="POST">
                @csrf
                @if(isset($miembro)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $miembro->nombre ?? (isset($miembro->nombre_completo) ? explode(' ', $miembro->nombre_completo)[0] : '')) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('nombre') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellido *</label>
                        <input type="text" name="apellido" value="{{ old('apellido', $miembro->apellido ?? (isset($miembro->nombre_completo) && strpos($miembro->nombre_completo, ' ') ? substr($miembro->nombre_completo, strpos($miembro->nombre_completo, ' ') + 1) : '')) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('apellido') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono / Celular</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $miembro->telefono ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $miembro->fecha_nacimiento ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dirección / Domicilio</label>
                    <textarea name="direccion" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('direccion', $miembro->direccion ?? '') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado del Miembro</label>
                    <select name="estado" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="activo" {{ old('estado', $miembro->estado ?? 'activo') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estado', $miembro->estado ?? '') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <a href="{{ route('miembros.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">← Volver al listado</a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        {{ isset($miembro) ? 'Guardar Cambios' : 'Registrar Miembro' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>