<x-guest-layout>
    <!-- Mensaje de estado -->
    @if(session('status'))
        <div style="background: #ECFCCB; color: #3F6212; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Correo -->
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="tu@correo.com">
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contraseña con botón ver/ocultar -->
        <div class="form-group" style="position: relative;">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required placeholder="Ingresa tu contraseña">
            <button type="button" onclick="togglePassword('password', 'icon1')" style="position: absolute; right: 12px; top: 38px; background: none; border: none; font-size: 18px; cursor: pointer; color: #64748B;">
                <span id="icon1">👁️</span>
            </button>
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Recordar -->
        <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
            <input type="checkbox" id="remember" name="remember" style="width: auto; margin: 0;">
            <label for="remember" style="margin: 0; font-weight: 400;">Recordar mis datos</label>
        </div>

        <!-- Botón Ingresar -->
        <button type="submit" class="btn-primary">Iniciar Sesión</button>

        <div class="divider"></div>

        <!-- ¿Olvidaste tu contraseña? -->
        <div class="text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-text">¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <!-- ❌ ENLACE DE REGISTRO ELIMINADO -- SOLO ADMIN CREA CUENTAS -->

        <a href="{{ url('/') }}" class="btn-secondary" style="display: block; text-align: center; margin-top: 20px;">← Volver al inicio</a>
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