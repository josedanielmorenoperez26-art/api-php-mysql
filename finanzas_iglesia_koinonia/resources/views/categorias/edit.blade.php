<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Categoría') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Nombre *</label>
                        <input type="text" name="nombre" class="w-full border border-gray-300 rounded p-2" value="{{ old('nombre', $categoria->nombre) }}" required>
                    </div>

                    <!-- ✅ CAMPO TIPO DE CATEGORÍA -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Tipo *</label>
                        <select name="tipo" class="w-full border border-gray-300 rounded p-2" required>
                            <option value="">Seleccione...</option>
                            <option value="ingreso" {{ old('tipo', $categoria->tipo) === 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                            <option value="gasto" {{ old('tipo', $categoria->tipo) === 'gasto' ? 'selected' : '' }}>Gasto</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3" class="w-full border border-gray-300 rounded p-2">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    </div>

                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>