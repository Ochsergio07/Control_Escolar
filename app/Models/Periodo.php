<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model {
    protected $table = 'periodo'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idperiodo'; // Clave primaria de la tabla

    // Relación con la tabla carrera
    public function carrera() {
        return $this->belongsTo(Carrera::class, 'idcarrera');
    }
}