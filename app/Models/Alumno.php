<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumno';
    protected $primaryKey = 'idalumno';
    
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'idcarrera');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'idalumno');
    }
}