<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gasto extends Model
{
    protected $fillable = [
        'categoria_id',
        'monto',
        'fecha_hora',
        'comprobante',
        'descripcion'
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}