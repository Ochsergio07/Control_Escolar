<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model {
    protected $table = 'carrera'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idcarrera'; // Clave primaria de la tabla

    // Relación con la tabla periodos
    public function periodos() {
        return $this->hasMany(Periodo::class, 'idcarrera');
    }
}