<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div class="form-group">
            <label for="name">Nombre Completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ej: José Pérez">
            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Correo -->
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="tu@correo.com">
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contraseña nueva -->
        <div class="form-group" style="position: relative;">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required placeholder="Mínimo 8 caracteres">
            <button type="button" onclick="togglePassword('password', 'icon1')" style="position: absolute; right: 12px; top: 38px; background: none; border: none; font-size: 18px; cursor: pointer; color: #64748B;">
                <span id="icon1">👁️</span>
            </button>
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div class="form-group" style="position: relative;">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repite tu contraseña">
            <button type="button" onclick="togglePassword('password_confirmation', 'icon2')" style="position: absolute; right: 12px; top: 38px; background: none; border: none; font-size: 18px; cursor: pointer; color: #64748B;">
                <span id="icon2">👁️</span>
            </button>
        </div>

        <!-- Botón Registrar -->
        <button type="submit" class="btn-primary">Crear Cuenta</button>

        <div class="divider"></div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="link-text">¿Ya tienes cuenta? Inicia sesión</a>
        </div>

        <a href="{{ url('/') }}" class="btn-secondary">← Volver al inicio</a>
    </form>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }
    </script>

</x-guest-layout>