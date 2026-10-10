<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">➕ Nuevo Ingreso</h1>
            <p class="text-gray-600">Registre un nuevo ingreso</p>
        </div>

        <div class="max-w-lg mx-auto bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
            <form action="{{ route('ingresos.store') }}" method="POST">
                @csrf

                <!-- 📅 FILA 1: Fecha y Hora | Categoría -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">📅 Fecha y Hora *</label>
                        <input type="datetime-local" name="fecha_hora" 
                            value="{{ now('America/La_Paz')->format('Y-m-d\TH:i') }}"
                            class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">📂 Categoría *</label>
                        <select name="categoria_id" 
                            class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required>
                            <option value="">-- Seleccione --</option>
                            @foreach($categoriasIngreso as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 💰 FILA 2: Monto | Miembro -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">💰 Monto (Bs.) *</label>
                        <input type="number" name="monto" step="0.01" 
                            class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="0.00" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">👤 Miembro (Opcional)</label>
                        <select name="miembro_id" 
                            class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            <option value="">-- Sin miembro --</option>
                            @foreach($miembros as $m)
                                <option value="{{ $m->id }}">{{ $m->nombre }} {{ $m->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 📝 Descripción -->
                <div class="mb-6">
                    <label class="block font-medium text-sm text-gray-700 mb-1">📝 Descripción</label>
                    <textarea name="descripcion" rows="3" 
                        class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Observaciones..."></textarea>
                </div>

                <!-- 🔘 Botones con color azul -->
                <div class="flex gap-4">
                    <a href="{{ route('finanzas.index') }}" 
                        class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md text-center transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="flex-1 py-3 bg-blue-800 hover:bg-blue-900 text-white font-bold rounded-lg shadow-md transition">
                        💾 Guardar Ingreso
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>