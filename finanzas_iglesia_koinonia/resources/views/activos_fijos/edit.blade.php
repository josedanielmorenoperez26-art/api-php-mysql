<x-app-layout>
    <div class="p-6">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-6">✏️ Editar Activo Fijo</h2>

            <form action="{{ route('activos_fijos.update', $activos_fijo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium mb-1">Nombre *</label>
                        <input type="text" name="nombre" value="{{ $activos_fijo->nombre }}" required class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Código</label>
                        <input type="text" name="codigo" value="{{ $activos_fijo->codigo }}" class="w-full border rounded-lg p-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium mb-1">Categoría</label>
                        <select name="categoria" class="w-full border rounded-lg p-2">
                            <option value="">Seleccionar</option>
                            <option {{ $activos_fijo->categoria == 'Equipo de Cómputo' ? 'selected' : '' }}>Equipo de Cómputo</option>
                            <option {{ $activos_fijo->categoria == 'Mobiliario' ? 'selected' : '' }}>Mobiliario</option>
                            <option {{ $activos_fijo->categoria == 'Equipo de Sonido' ? 'selected' : '' }}>Equipo de Sonido</option>
                            <option {{ $activos_fijo->categoria == 'Electrodomésticos' ? 'selected' : '' }}>Electrodomésticos</option>
                            <option {{ $activos_fijo->categoria == 'Inmueble' ? 'selected' : '' }}>Inmueble</option>
                            <option {{ $activos_fijo->categoria == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Estado *</label>
                        <select name="estado" required class="w-full border rounded-lg p-2">
                            <option value="activo" {{ $activos_fijo->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="en reparación" {{ $activos_fijo->estado == 'en reparación' ? 'selected' : '' }}>En Reparación</option>
                            <option value="dado de baja" {{ $activos_fijo->estado == 'dado de baja' ? 'selected' : '' }}>Dado de Baja</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium mb-1">Valor de Compra (Bs) *</label>
                        <input type="number" step="0.01" name="valor_compra" value="{{ $activos_fijo->valor_compra }}" required class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Fecha de Compra</label>
                        <input type="date" name="fecha_compra" value="{{ $activos_fijo->fecha_compra }}" class="w-full border rounded-lg p-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Vida Útil (meses)</label>
                    <input type="number" name="vida_util_meses" value="{{ $activos_fijo->vida_util_meses }}" placeholder="Ej: 60 = 5 años" class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Ubicación</label>
                    <input type="text" name="ubicacion" value="{{ $activos_fijo->ubicacion }}" class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-6">
                    <label class="block font-medium mb-1">Descripción</label>
                    <textarea name="descripcion" rows="3" class="w-full border rounded-lg p-2">{{ $activos_fijo->descripcion }}</textarea>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('activos_fijos.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Cancelar</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Actualizar Activo</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>