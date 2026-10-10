<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoFijo extends Model
{
    use HasFactory;

    // ✅ AGREGA ESTA LÍNEA — DICE EXACTAMENTE EL NOMBRE DE LA TABLA
    protected $table = 'activos_fijos';

    protected $fillable = [
        'nombre',
        'codigo',
        'categoria',
        'valor_compra',
        'fecha_compra',
        'vida_util_meses',
        'estado',
        'ubicacion',
        'descripcion',
    ];

    // Cálculo de depreciación mensual
    public function getDepreciacionMensualAttribute()
    {
        if (!$this->vida_util_meses || $this->vida_util_meses == 0) return 0;
        return $this->valor_compra / $this->vida_util_meses;
    }

    // Valor actual (aproximado)
    public function getValorActualAttribute()
    {
        if (!$this->fecha_compra || !$this->vida_util_meses) return $this->valor_compra;
        $mesesTranscurridos = now()->diffInMonths($this->fecha_compra);
        $depreciacionTotal = $mesesTranscurridos * $this->depreciacion_mensual;
        $valorActual = $this->valor_compra - $depreciacionTotal;
        return max(0, $valorActual);
    }
}