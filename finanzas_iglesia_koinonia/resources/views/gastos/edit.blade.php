<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Gasto') }}
        </h2>
        <p class="text-gray-500 text-sm mt-1">Modifique los datos del gasto</p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('gastos.update', $gasto) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ✅ Categoría de Gasto -->
                    <div class="mb-5">
                        <label class="block font-medium text-gray-700 mb-2">Categoría *</label>
                        <select name="categoria_id" class="w-full border border-gray-300 rounded-md p-2" required>
                            <option value="">-- Seleccione una categoría --</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ old('categoria_id', $gasto->categoria_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ✅ Descripción -->
                    <div class="mb-5">
                        <label class="block font-medium text-gray-700 mb-2">Descripción</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion', $gasto->descripcion) }}" placeholder="Ej: Compra de materiales"
                               class="w-full border border-gray-300 rounded-md p-2">
                    </div>

                    <!-- ✅ Monto -->
                    <div class="mb-5">
                        <label class="block font-medium text-gray-700 mb-2">Monto (Bs) *</label>
                        <input type="number" name="monto" step="0.01" min="0" value="{{ old('monto', $gasto->monto) }}"
                               class="w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <!-- ✅ Fecha -->
                    <div class="mb-5">
                        <label class="block font-medium text-gray-700 mb-2">Fecha *</label>
                        <input type="date" name="fecha" value="{{ old('fecha', $gasto->fecha) }}"
                               class="w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <!-- ✅ Botones -->
                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('finanzas.index') }}"
                           class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Cancelar
                        </a>
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Actualizar Gasto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>