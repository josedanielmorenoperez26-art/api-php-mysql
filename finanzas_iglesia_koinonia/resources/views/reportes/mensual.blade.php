<x-app-layout>
    <x-slot name="header">
        📊 Reporte Mensual - Iglesia Koinonia
    </x-slot>

    <div class="card">
        <!-- Selección de mes y año -->
        <form action="{{ route('reportes.mensual') }}" method="GET" class="mb-4 d-flex gap-3 align-items-center">
            <label class="form-label">Ver mes:</label>
            <select name="mes" class="form-control w-auto">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $mes == $m ? 'selected' : '' }}>
                        {{ ucfirst(strftime('%B', mktime(0,0,0,$m,1))) }}
                    </option>
                @endfor
            </select>

            <select name="anio" class="form-control w-auto">
                @for ($a = 2025; $a <= Carbon::now()->year; $a++)
                    <option value="{{ $a }}" {{ $anio == $a ? 'selected' : '' }}>
                        {{ $a }}
                    </option>
                @endfor
            </select>

            <button type="submit" class="btn btn-primary">Ver Reporte</button>
        </form>

        <h3 class="text-center text-primary mb-4">
            Resumen: {{ $nombreMes }} de {{ $anio }}
        </h3>

        <!-- Tabla por áreas -->
        <table class="table table-striped w-full">
            <thead>
                <tr class="bg-light">
                    <th>Área / Fondo</th>
                    <th class="text-right">Total Ingresos (Bs)</th>
                    <th class="text-right">Total Gastos (Bs)</th>
                    <th class="text-right">Saldo Actual (Bs)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $fila)
                <tr>
                    <td><strong>{{ $fila['area'] }}</strong></td>
                    <td class="text-right">{{ number_format($fila['ingresos'], 2) }}</td>
                    <td class="text-right">{{ number_format($fila['gastos'], 2) }}</td>
                    <td class="text-right {{ $fila['saldo'] >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format($fila['saldo'], 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="fw-bold bg-light">
                    <td>TOTAL GENERAL</td>
                    <td class="text-right">{{ number_format($totalIngresos, 2) }}</td>
                    <td class="text-right">{{ number_format($totalGastos, 2) }}</td>
                    <td class="text-right {{ $saldoGeneral >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format($saldoGeneral, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-4 text-center text-muted">
            <small>Reporte generado el: {{ Carbon::now()->format('d/m/Y H:i') }}</small>
        </div>
    </div>
</x-app-layout>