<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Ministerios</h1>
                <p class="text-gray-600">Administra los ministerios y áreas de servicio de tu iglesia</p>
            </div>
            <a href="{{ route('ministerios.create') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                ➕ Nuevo Ministerio
            </a>
        </div>

        <!-- BUSCADOR Y FILTRO -->
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <form action="{{ route('ministerios.index') }}" method="GET" class="flex flex-1 max-w-md gap-2">
                <input type="text" name="buscar" placeholder="Buscar ministerios..." value="{{ $buscar }}" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">🔍</button>
            </form>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="solo_activos" form="filtro-form" onchange="document.getElementById('filtro-form').submit()" @checked($soloActivos) class="w-4 h-4 text-blue-600">
                <span class="text-gray-700">Mostrar solo activos</span>
            </label>
            <form id="filtro-form" action="{{ route('ministerios.index') }}" method="GET" class="hidden">
                @if($buscar) <input type="hidden" name="buscar" value="{{ $buscar }}"> @endif
                <input type="hidden" name="solo_activos" value="1">
            </form>
        </div>

        <!-- TARJETAS DE RESUMEN -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-blue-600">
                <p class="text-sm text-gray-500">Total Ministerios</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $ministerios->count() }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-green-500">
                <p class="text-sm text-gray-500">Ministerios Activos</p>
                <h3 class="text-3xl font-bold text-green-600 mt-1">{{ $ministerios->where('estado','activo')->count() }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-amber-500">
                <p class="text-sm text-gray-500">Total Participantes</p>
                <h3 class="text-3xl font-bold text-amber-600 mt-1">{{ $totalParticipantes }}</h3>
            </div>
        </div>

        <!-- LISTADO DE MINISTERIOS EN TARJETAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($ministerios as $min)
            <div class="bg-white rounded-xl shadow overflow-hidden border-t-4 {{ $min->estado == 'activo' ? 'border-blue-700' : 'border-gray-400' }}">
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-bold text-gray-800">{{ $min->nombre }}</h3>
                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $min->estado == 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                            {{ $min->estado == 'activo' ? 'ACTIVO' : 'INACTIVO' }}
                        </span>
                    </div>

                    <p class="text-gray-600 mt-3 text-sm leading-relaxed min-h-[60px]">
                        {{ $min->descripcion ?? 'Sin descripción registrada' }}
                    </p>

                    <div class="mt-4 space-y-2 text-sm">
                        @if($min->lider)
                        <div><strong class="text-gray-700">Líder:</strong> {{ $min->lider->nombre_completo }}</div>
                        @endif
                        @if($min->horario_reuniones)
                        <div><strong class="text-gray-700">Reuniones:</strong> {{ $min->horario_reuniones }}</div>
                        @endif
                        <div><strong class="text-gray-700">Participantes:</strong> {{ $min->cantidad_participantes }} miembros</div>
                    </div>

                    <!-- BOTONES DE ACCIÓN IGUAL AL EJEMPLO -->
                    <div class="flex flex-wrap gap-2 mt-5 pt-4 border-t border-gray-100">
                        <a href="{{ route('ministerios.show', $min) }}" class="px-3 py-1.5 bg-blue-100 text-blue-800 rounded-md text-xs font-semibold hover:bg-blue-200">👁️ Ver</a>
                        <a href="{{ route('ministerios.edit', $min) }}" class="px-3 py-1.5 bg-yellow-100 text-yellow-800 rounded-md text-xs font-semibold hover:bg-yellow-200">✏️ Editar</a>
                        <a href="{{ route('ministerios.miembros', $min) }}" class="px-3 py-1.5 bg-cyan-100 text-cyan-800 rounded-md text-xs font-semibold hover:bg-cyan-200">👥 Miembros</a>
                        <form action="{{ route('ministerios.update', $min) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="nombre" value="{{ $min->nombre }}">
                            <input type="hidden" name="descripcion" value="{{ $min->descripcion }}">
                            <input type="hidden" name="horario_reuniones" value="{{ $min->horario_reuniones }}">
                            <input type="hidden" name="lider_id" value="{{ $min->lider_id }}">
                            <input type="hidden" name="estado" value="{{ $min->estado == 'activo' ? 'inactivo' : 'activo' }}">
                            <button type="submit" class="px-3 py-1.5 bg-gray-100 text-gray-800 rounded-md text-xs font-semibold hover:bg-gray-200">
                                {{ $min->estado == 'activo' ? '⏸️ Pausar' : '▶️ Activar' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>