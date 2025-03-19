<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model {
    protected $table = 'asignacion';
    protected $primaryKey = 'idasignacion';

    // Deshabilitar timestamps (created_at y updated_at)
    public $timestamps = false;

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'idperiodo',
        'idalumno'
    ];

    // Relación con la tabla periodo
    public function periodo() {
        return $this->belongsTo(Periodo::class, 'idperiodo');
    }

    // Relación con la tabla alumno
    public function alumno() {
        return $this->belongsTo(Alumno::class, 'idalumno');
    }
}