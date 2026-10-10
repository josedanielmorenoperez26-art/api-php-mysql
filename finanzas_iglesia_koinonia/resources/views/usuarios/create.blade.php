<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Crear Nuevo Usuario
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('usuarios.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nombre Completo</label>
                        <input type="text" name="name" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="Nombre del usuario">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Correo Electrónico</label>
                        <input type="email" name="email" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="correo@ejemplo.com">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Contraseña</label>
                        <input type="password" name="password" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="Mínimo 6 caracteres">
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Rol / Permiso</label>
                        <select name="rol" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="secretario">Secretario (Registra ingresos y gastos)</option>
                            <option value="administrador">Administrador (Control total)</option>
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('usuarios.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Cancelar</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md font-medium">✅ Crear Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>