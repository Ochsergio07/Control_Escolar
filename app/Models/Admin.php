<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'admin';

    // Clave primaria de la tabla
    protected $primaryKey = 'idadmin';

    // Deshabilitar timestamps (created_at y updated_at)
    public $timestamps = false;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'alias',
        'password',
        'nivel',
        'foto',
        'correo',
    ];
}