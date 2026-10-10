<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'tipo', 'descripcion'];

    public function ingresos(): HasMany
    {
        return $this->hasMany(Ingreso::class);
    }

    public function gastos(): HasMany
    {
        return $this->hasMany(Gasto::class);
    }
}