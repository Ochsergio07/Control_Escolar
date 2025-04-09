<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;

class CarreraController extends Controller
{
    public function index()
{
    $carreras = Carrera::all(); 
    return view('welcome', compact('carreras')); 
}

    

    public function obtenerCarrera()
    {
        return response()->json(Carrera::all());
    }

    public function guardarCarrera(Request $request)
{
    $request->validate([
        'carrera' => 'required|array',
        'carrera.*.nombre' => 'required|string|max:255',
        'carrera.*.rvoe' => 'required|string|max:255',
    ]);

    foreach ($request->carrera as $carreraData) {
        Carrera::create([
            'nombre' => $carreraData['nombre'],
            'rvoe' => $carreraData['rvoe']
        ]);
    }

    return response()->json(['success' => true]);
}

public function editarCarrera(Request $request, $id)
{
    $carrera = Carrera::find($id);
    
    if (!$carrera) {
        return response()->json(['error' => 'Carrera no encontrada'], 404);
    }

    $carrera->update([
        'nombre' => $request->nombre,
        'rvoe' => $request->rvoe
    ]);

    return response()->json(['success' => true, 'carrera' => $carrera]);
}


public function eliminarCarrera($id)
{
    Carrera::destroy($id);
    return response()->json(['success' => true]);
}


    
}
