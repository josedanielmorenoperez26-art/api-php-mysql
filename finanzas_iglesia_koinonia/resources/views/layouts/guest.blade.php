<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Finanzas - Iglesia Koinonía</title>

    <!-- Fuentes y estilos -->
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

        .login-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(30, 64, 175, 0.2);
            padding: 45px 40px;
            border-top: 5px solid #0369A1;
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h1 {
            color: #0E4A77;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748B;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            color: #334155;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px 16px;
            border: 2px solid #BFDBFE;
            border-radius: 8px;
            font-size: 15px;
            background-color: #F8FAFC;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #0369A1;
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(3, 105, 161, 0.15);
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #0369A1 0%, #0284C7 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #075985 0%, #0369A1 100%);
            box-shadow: 0 4px 12px rgba(3, 105, 161, 0.25);
        }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            background-color: #F1F5F9;
            color: #334155;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            margin-top: 12px;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            transition: background 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: #E2E8F0;
            color: #0F172A;
        }

        .link-text {
            color: #0369A1;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .link-text:hover {
            color: #075985;
            text-decoration: underline;
        }

        .divider {
            height: 1px;
            background-color: #E2E8F0;
            margin: 25px 0;
        }

        .text-center {
            text-align: center;
        }

        .error-msg {
            color: #DC2626;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="header">
        <h1>Iglesia Koinonía</h1>
        <p>Sistema de Control de Finanzas</p>
    </div>

    {{ $slot }}
</div>

</body>
</html>