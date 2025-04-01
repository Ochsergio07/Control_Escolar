<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignacion';
    protected $primaryKey = 'idasignacion';
    public $timestamps = false;
    
    protected $fillable = ['idperiodo', 'idalumno'];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idperiodo');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'idalumno');
    }
}