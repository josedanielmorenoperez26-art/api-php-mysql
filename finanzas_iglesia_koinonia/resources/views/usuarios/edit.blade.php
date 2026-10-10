<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Usuario / Cambiar Contraseña
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nueva Contraseña <span class="text-gray-400">(Dejar vacío para NO cambiar)</span></label>
                        <input type="password" name="password" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="Escribir solo si desea cambiarla">
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Rol / Permiso</label>
                        <select name="rol" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="secretario" {{ $usuario->rol === 'secretario' ? 'selected' : '' }}>Secretario</option>
                            <option value="administrador" {{ $usuario->rol === 'administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('usuarios.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Cancelar</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md font-medium">✅ Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>