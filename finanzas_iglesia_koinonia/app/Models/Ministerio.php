<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministerio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'horario_reuniones',
        'lider_id',
        'estado',
    ];

    // Relación con el Líder
    public function lider()
    {
        return $this->belongsTo(Miembro::class, 'lider_id');
    }

    // Relación con TODOS los Miembros asignados al ministerio
    public function miembros()
    {
        return $this->belongsToMany(Miembro::class, 'miembro_ministerio');
    }

    // Contador rápido de participantes
    public function getCantidadParticipantesAttribute()
    {
        return $this->miembros()->count();
    }
}