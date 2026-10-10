<?php
use Illuminate\Support\Facades\Auth;
?>
<!-- MENÚ LATERAL AZUL - CON GESTIÓN DE USUARIOS AGREGADO -->
<div class="w-64 bg-blue-800 min-h-screen shadow-xl flex flex-col text-white">
    <!-- Encabezado del menú -->
    <div class="px-6 py-6 border-b border-blue-600">
        <h2 class="text-xl font-bold">Iglesia Koinonia</h2>
        <p class="text-sm text-blue-200">Sistema de Gestión</p>
    </div>

    <!-- Opciones del menú -->
    <nav class="flex-grow mt-6 px-3 space-y-1">
        <a href="/dashboard" class="flex items-center px-4 py-3 rounded-lg font-medium transition-all
            {{ request()->is('dashboard') ? 'bg-blue-600 border-l-4 border-white' : 'hover:bg-blue-700' }}">
            <span class="mr-3 text-lg">📊</span> Dashboard
        </a>

        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-blue-300 uppercase">Gestión Principal</p>

        <!-- ✅ SOLO EL ADMINISTRADOR VE ESTA OPCIÓN -->
        @if(Auth::check() && Auth::user()->rol === 'administrador')
        <a href="{{ route('usuarios.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium transition-all
            {{ request()->routeIs('usuarios.*') ? 'bg-blue-600 border-l-4 border-white' : 'hover:bg-blue-700' }}">
            <span class="mr-3 text-lg">👤</span> Gestionar Usuarios
        </a>
        @endif

        <a href="/miembros" class="flex items-center px-4 py-3 rounded-lg font-medium transition-all
            {{ request()->is('miembros*') ? 'bg-blue-600 border-l-4 border-white' : 'hover:bg-blue-700' }}">
            <span class="mr-3 text-lg">👥</span> Miembros
        </a>

        <a href="/ministerios" class="flex items-center px-4 py-3 rounded-lg font-medium transition-all
            {{ request()->is('ministerios*') ? 'bg-blue-600 border-l-4 border-white' : 'hover:bg-blue-700' }}">
            <span class="mr-3 text-lg">🏠</span> Ministerios
        </a>

        <a href="/finanzas" class="flex items-center px-4 py-3 rounded-lg font-medium transition-all
            {{ request()->is('finanzas*') ? 'bg-blue-600 border-l-4 border-white' : 'hover:bg-blue-700' }}">
            <span class="mr-3 text-lg">💰</span> Finanzas
        </a>

        <!-- ✅ ACTIVOS FIJOS -->
        <a href="{{ route('activos_fijos.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium transition-all
            {{ request()->routeIs('activos_fijos.*') ? 'bg-blue-600 border-l-4 border-white' : 'hover:bg-blue-700' }}">
            <span class="mr-3 text-lg">📦</span> Activos Fijos
        </a>

        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-blue-300 uppercase">Otros</p>

        <a href="/categorias" class="flex items-center px-4 py-3 rounded-lg font-medium hover:bg-blue-700 transition-all">
            <span class="mr-3 text-lg">📂</span> Categorías
        </a>

        <a href="/reportes" class="flex items-center px-4 py-3 rounded-lg font-medium hover:bg-blue-700 transition-all">
            <span class="mr-3 text-lg">📈</span> Reportes
        </a>
    </nav>

    <!-- Pie del menú - Usuario y Cerrar Sesión -->
    <div class="px-6 py-5 border-t border-blue-600 mt-auto">
        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
        <form method="POST" action="/logout" class="mt-2">
            @csrf
            <button type="submit" class="text-sm text-blue-200 hover:text-white">Cerrar Sesión</button>
        </form>
    </div>
</div>