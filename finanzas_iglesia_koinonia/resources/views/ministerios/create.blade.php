<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Registrar Nuevo Ministerio</h1>
            <p class="text-gray-600">Datos del área de servicio de la iglesia</p>
        </div>

        <div class="max-w-2xl bg-white rounded-xl shadow p-6">
            <form action="{{ route('ministerios.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Ministerio *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('nombre') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Líder Responsable</label>
                    <select name="lider_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Selecciona un miembro activo --</option>
                        @foreach($miembros as $m)
                        <option value="{{ $m->id }}" {{ old('lider_id') == $m->id ? 'selected' : '' }}>{{ $m->nombre_completo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Horario de Reuniones</label>
                    <input type="text" name="horario_reuniones" value="{{ old('horario_reuniones') }}" placeholder="Ej: Jueves 7:00 PM" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción / Propósito</label>
                    <textarea name="descripcion" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="estado" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="activo" selected>✅ Activo</option>
                        <option value="inactivo">⏸️ Inactivo</option>
                    </select>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <a href="{{ route('ministerios.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">← Volver</a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Registrar Ministerio</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>