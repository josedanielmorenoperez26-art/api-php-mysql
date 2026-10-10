<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Iglesia Koinonia') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    /* Botón menú - solo visible en celular */
    .menu-toggle { display: none; }

    @media (max-width: 768px) {
        /* Mostrar botón ☰ */
        .menu-toggle {
            display: flex !important;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 50;
            background: #1e40af;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 1.25rem;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        /* Menú oculto por defecto */
        .sidebar {
            position: fixed !important;
            left: -100% !important;
            top: 0 !important;
            height: 100vh !important;
            z-index: 40 !important;
            transition: left 0.3s ease !important;
            width: 220px !important;
        }

        /* Menú visible al activar */
        .sidebar.open {
            left: 0 !important;
        }

        /* Contenido sin recortes */
        .main-content {
            width: 100% !important;
            margin-left: 0 !important;
        }

        /* Tarjetas en 1 columna */
        .grid-cols-4, .grid-cols-6, .grid-cols-3 {
            grid-template-columns: 1fr !important;
        }

        /* Espacios reducidos */
        main { padding: 1rem !important; }
        .max-w-7xl { max-width: 100% !important; padding: 0 0.5rem !important; }
    }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Botón para abrir/cerrar menú SOLO en celular -->
    <button class="menu-toggle" onclick="toggleMenu()">☰ Menú</button>

    <div class="flex min-h-screen">
        <!-- Menú lateral con clase -->
        <div class="sidebar w-64 bg-blue-800 min-h-screen shadow-xl flex flex-col text-white" id="sidebar">
            @include('layouts.navigation')
        </div>

        <!-- Contenido principal con clase -->
        <div class="main-content flex flex-col flex-1">
            @isset($header)
                <header class="bg-white shadow mt-12 md:mt-0">
                    <div class="max-w-7xl mx-auto py-4 px-3">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Script para abrir/cerrar -->
    <script>
    function toggleMenu() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
    }
    // Cerrar al tocar fuera
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidebar');
        const btn = document.querySelector('.menu-toggle');
        if (!sidebar.contains(e.target) && !btn.contains(e.target)) {
            sidebar.classList.remove('open');
        }
    });
    </script>
</body>
</html>