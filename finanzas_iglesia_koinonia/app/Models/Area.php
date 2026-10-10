<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }

    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
}