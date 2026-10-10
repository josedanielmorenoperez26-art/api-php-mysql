<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Finanzas - Iglesia Koinonía</title>
    <!-- Fuente igual al resto del sistema -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 50%, #7DD3FC 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .main-card {
            width: 100%;
            max-width: 750px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(3, 105, 161, 0.2);
            padding: 40px 30px;
            text-align: center;
            border-top: 5px solid #0369A1;
        }
        .main-card h1 {
            color: #0E4A77;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.3;
        }
        .main-card h2 {
            color: #0369A1;
            font-size: 22px;
            font-weight: 500;
            margin-bottom: 25px;
        }
        .description {
            color: #475569;
            font-size: 17px;
            line-height: 1.6;
            margin-bottom: 35px;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
        }
        .info-text {
            color: #64748B;
            font-size: 14px;
            margin-bottom: 40px;
            line-height: 1.5;
        }
        .buttons-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-blue {
            padding: 14px 32px;
            background: linear-gradient(90deg, #0369A1 0%, #0284C7 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            min-width: 220px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 8px rgba(3, 105, 161, 0.15);
        }
        .btn-blue:hover {
            background: linear-gradient(90deg, #075985 0%, #0369A1 100%);
            box-shadow: 0 5px 12px rgba(3, 105, 161, 0.25);
            transform: translateY(-1px);
        }
        /* ✅ ESTILO DEL LOGO */
        .logo-img {
            width: 96px;
            height: 96px;
            object-fit: contain;
            margin-bottom: 24px;
        }
        @media (min-width: 768px) {
            .logo-img {
                width: 112px;
                height: 112px;
            }
        }
        @media (max-width: 480px) {
            .main-card h1 {
                font-size: 26px;
            }
            .main-card h2 {
                font-size: 19px;
            }
            .btn-blue {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="main-card">
    <!-- ✅ LOGO TAMAÑO AJUSTADO -->
    <img src="{{ asset('images/logo-koinonia.png') }}" 
         alt="Iglesia Koinonía" 
         class="logo-img mx-auto d-block">

    <h1>SISTEMA WEB DE CONTROL DE FINANZAS</h1>
    <h2>Iglesia Cristiana "Koinonía" - Riberalta</h2>
    <p class="description">
        Registro centralizado de diezmos, ofrendas, aportes y gastos. Control de deudas, cálculo automático de saldos y generación de informes mensuales confiables.
    </p>
    <p class="info-text">
        Desarrollado por: Gabriel Conotiri Amutari & José Daniel Moreno Pérez<br>
        Instituto Tecnológico Superior de la Amazonía Riberalta - 2026
    </p>
    <div class="buttons-container">
        @auth
            <a href="{{ route('dashboard') }}" class="btn-blue">Ir al Panel</a>
        @else
            <!-- ✅ SOLO INICIAR SESIÓN — SIN REGISTRO PÚBLICO -->
            <a href="{{ route('login') }}" class="btn-blue">🔐 Iniciar Sesión</a>
        @endauth
    </div>
</div>
</body>
</html>