<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Categorías') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ✅ PESTAÑAS: Ingresos / Gastos -->
                <div class="mb-6 flex gap-3 border-b border-gray-200 pb-4">
                    <a href="{{ route('categorias.index', ['tipo' => 'ingreso']) }}" 
                       class="px-4 py-2 rounded-t-lg font-medium text-sm
                              {{ $tipo === 'ingreso' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        📥 Categorías de Ingresos
                    </a>
                    <a href="{{ route('categorias.index', ['tipo' => 'gasto']) }}" 
                       class="px-4 py-2 rounded-t-lg font-medium text-sm
                              {{ $tipo === 'gasto' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        📤 Categorías de Gastos
                    </a>
                </div>

                <a href="{{ route('categorias.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Nueva Categoría
                </a>

                <table class="w-full mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">Nombre</th>
                            <th class="border p-2 text-left">Tipo</th>
                            <th class="border p-2 text-left">Descripción</th>
                            <th class="border p-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td class="border p-2">{{ $categoria->nombre }}</td>
                            <td class="border p-2">
                                <span class="px-2 py-1 rounded text-white {{ $categoria->tipo == 'ingreso' ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ ucfirst($categoria->tipo) }}
                                </span>
                            </td>
                            <td class="border p-2">{{ $categoria->descripcion ?? 'Sin descripción' }}</td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('categorias.edit', $categoria) }}" class="px-2 py-1 bg-amber-500 text-white rounded text-sm">Editar</a>
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $categorias->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>