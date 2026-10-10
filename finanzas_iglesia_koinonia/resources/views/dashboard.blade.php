<x-app-layout>
    <!-- ✅ ENCABEZADO AZUL INTERNO -->
    <div style="background: linear-gradient(90deg, #1e40af, #2563eb); border-radius: 12px; padding: 32px; margin-bottom: 32px; color: white;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 8px;">¡Bienvenido de vuelta!</h1>
        <p style="opacity: 0.9;">Resumen de la actividad de tu iglesia</p>
        <p style="opacity: 0.8; font-size: 14px; margin-top: 4px;">Iglesia Koinonia</p>
    </div>

    <!-- ✅ TARJETAS PRINCIPALES -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px;">
        <!-- TOTAL MIEMBROS -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000001a; padding: 24px; border-left: 4px solid #3b82f6;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-size: 32px; font-weight: bold; color: #1f2937;">{{ App\Models\Miembro::count() }}</p>
                    <p style="color: #6b7280; font-size: 14px; text-transform: uppercase; margin-top: 4px;">Total Miembros</p>
                </div>
                <div style="width: 48px; height: 48px; background: #dbeafe; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #2563eb; font-size: 20px;">👥</div>
            </div>
        </div>
        <!-- MIEMBROS ACTIVOS -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000001a; padding: 24px; border-left: 4px solid #22c55e;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-size: 32px; font-weight: bold; color: #1f2937;">{{ App\Models\Miembro::where('estado','activo')->count() }}</p>
                    <p style="color: #6b7280; font-size: 14px; text-transform: uppercase; margin-top: 4px;">Miembros Activos</p>
                </div>
                <div style="width: 48px; height: 48px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #16a34a; font-size: 20px;">✅</div>
            </div>
        </div>
        <!-- MINISTERIOS -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000001a; padding: 24px; border-left: 4px solid #eab308;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-size: 32px; font-weight: bold; color: #1f2937;">{{ App\Models\Ministerio::count() }}</p>
                    <p style="color: #6b7280; font-size: 14px; text-transform: uppercase; margin-top: 4px;">Ministerios</p>
                </div>
                <div style="width: 48px; height: 48px; background: #fef3c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #ca8a04; font-size: 20px;">🏠</div>
            </div>
        </div>
        <!-- NUEVOS ESTE MES -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000001a; padding: 24px; border-left: 4px solid #a855f7;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-size: 32px; font-weight: bold; color: #1f2937;">{{ App\Models\Miembro::whereMonth('created_at', now()->month)->count() }}</p>
                    <p style="color: #6b7280; font-size: 14px; text-transform: uppercase; margin-top: 4px;">Nuevos este mes</p>
                </div>
                <div style="width: 48px; height: 48px; background: #f3e8ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #9333ea; font-size: 20px;">🆕</div>
            </div>
        </div>
    </div>

    <!-- ✅ RESUMEN FINANCIERO + ACCIONES -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px; margin-bottom: 32px;">
        <!-- FINANCIERO -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000001a; overflow: hidden;">
            <div style="background: #1e40af; color: white; padding: 16px 24px;">
                <h3 style="font-weight: bold; font-size: 18px;">$ Resumen Financiero (Último Mes)</h3>
            </div>
            <div style="padding: 32px; text-align: center;">
                @php
                    // ✅ CAMBIADO: 'fecha' → 'fecha_hora'
                    $ingMes = App\Models\Ingreso::whereMonth('fecha_hora', now()->month)->sum('monto') ?? 0;
                    $gasMes = App\Models\Gasto::whereMonth('fecha_hora', now()->month)->sum('monto') ?? 0;
                    $balMes = $ingMes - $gasMes;
                @endphp
                <div style="margin-bottom: 20px;">
                    <p style="font-size: 28px; font-weight: bold; color: #16a34a;">Bs {{ number_format($ingMes, 2, ',', '.') }}</p>
                    <p style="color: #6b7280; margin-top: 4px;">Ingresos</p>
                </div>
                <div style="margin-bottom: 20px;">
                    <p style="font-size: 28px; font-weight: bold; color: #dc2626;">Bs {{ number_format($gasMes, 2, ',', '.') }}</p>
                    <p style="color: #6b7280; margin-top: 4px;">Gastos</p>
                </div>
                <hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 20px 0;">
                <div>
                    <p style="font-size: 24px; font-weight: bold; color: {{ $balMes >= 0 ? '#16a34a' : '#dc2626' }};">Balance Neto: Bs {{ number_format($balMes, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- ACCIONES RÁPIDAS -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000001a; overflow: hidden;">
            <div style="background: #1e40af; color: white; padding: 16px 24px;">
                <h3 style="font-weight: bold; font-size: 18px;">📋 Acciones Rápidas</h3>
            </div>
            <div style="padding: 24px; display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('miembros.index') }}" style="display: block; text-align: center; padding: 12px; background: #eff6ff; color: #1d4ed8; border-radius: 8px; text-decoration: none; font-weight: 600; border: 1px solid #bfdbfe;">👥 Gestionar Miembros</a>
                <a href="{{ route('finanzas.index') }}" style="display: block; text-align: center; padding: 12px; background: #f0fdf4; color: #16a34a; border-radius: 8px; text-decoration: none; font-weight: 600; border: 1px solid #bbf7d0;">💲 Control Financiero</a>
                <a href="#" style="display: block; text-align: center; padding: 12px; background: #fffbeb; color: #d97706; border-radius: 8px; text-decoration: none; font-weight: 600; border: 1px solid #fde68a;">🏢 Activos Fijos</a>
                <a href="{{ route('categorias.index') }}" style="display: block; text-align: center; padding: 12px; background: #ecfeff; color: #0891b2; border-radius: 8px; text-decoration: none; font-weight: 600; border: 1px solid #a5f3fc;">📁 Categorías</a>
            </div>
        </div>
    </div>

    <!-- ✅ MIEMBROS RECIENTES -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000001a; overflow: hidden;">
        <div style="background: #1e40af; color: white; padding: 16px 24px;">
            <h3 style="font-weight: bold; font-size: 18px;">🕒 Miembros Recientes</h3>
        </div>
        <div style="padding: 24px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb;">
                        <th style="text-align: left; padding-bottom: 12px; font-weight: 600; color: #374151;">Nombre</th>
                        <th style="text-align: left; padding-bottom: 12px; font-weight: 600; color: #374151;">Estado</th>
                        <th style="text-align: left; padding-bottom: 12px; font-weight: 600; color: #374151;">Fecha Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\Miembro::latest('created_at')->take(5)->get() as $m)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 16px 0; color: #1f2937;">{{ $m->nombre_completo ?? ($m->nombre.' '.$m->apellido) }}</td>
                        <td style="padding: 16px 0;"><span style="padding: 6px 12px; border-radius: 20px; font-size: 14px; font-weight: 500; background: {{ $m->estado == 'activo' ? '#dcfce7' : '#fee2e2' }}; color: {{ $m->estado == 'activo' ? '#166534' : '#991b1b' }};">{{ ucfirst($m->estado) }}</span></td>
                        <td style="padding: 16px 0; color: #4b5563;">{{ $m->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: center; margin-top: 24px;">
                <a href="{{ route('miembros.index') }}" style="color: #2563eb; text-decoration: underline; font-weight: 600;">Ver todos los miembros →</a>
            </div>
        </div>
    </div>
</x-app-layout>