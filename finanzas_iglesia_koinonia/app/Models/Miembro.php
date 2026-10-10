<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'nombre_completo',
        'telefono',
        'fecha_nacimiento',
        'direccion',
        'estado',
    ];

    // Relación: ministerios a los que pertenece el miembro
    public function ministerios()
    {
        return $this->belongsToMany(Ministerio::class, 'miembro_ministerio');
    }
}