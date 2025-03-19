<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model {
    protected $table = 'alumno';
    protected $primaryKey = 'idalumno';

    // Relación con la tabla carrera
    public function carrera() {
        return $this->belongsTo(Carrera::class, 'idcarrera');
    }

    // Relación con la tabla asignacion
    public function asignaciones() {
        return $this->hasMany(Asignacion::class, 'idalumno');
    }
}