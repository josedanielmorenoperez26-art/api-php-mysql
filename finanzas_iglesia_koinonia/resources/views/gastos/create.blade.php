<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">➖ Nuevo Gasto</h1>
            <p class="text-gray-600">Registre un nuevo gasto / egreso</p>
        </div>

        <div class="max-w-lg mx-auto bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
            <form action="{{ route('gastos.store') }}" method="POST">
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
                            @foreach($categoriasGasto as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 💰 FILA 2: Monto | Comprobante -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">💰 Monto (Bs.) *</label>
                        <input type="number" name="monto" step="0.01" 
                            class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="0.00" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">🧾 Comprobante</label>
                        <input type="text" name="comprobante" 
                            class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="N° factura / recibo">
                    </div>
                </div>

                <!-- 📝 Descripción -->
                <div class="mb-6">
                    <label class="block font-medium text-sm text-gray-700 mb-1">📝 Descripción</label>
                    <textarea name="descripcion" rows="3" 
                        class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Detalles del gasto..."></textarea>
                </div>

                <!-- 🔘 Botones: Cancelar azul | Guardar ROJO -->
                <div class="flex gap-4">
                    <a href="{{ route('finanzas.index') }}" 
                        class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md text-center transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="flex-1 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-md transition">
                        💾 Guardar Gasto
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>