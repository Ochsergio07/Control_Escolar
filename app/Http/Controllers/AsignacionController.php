<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Models\Periodo;
use App\Models\Alumno;
use App\Models\Asignacion;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all();
        return view('asignacion.index', compact('carreras'));
    }

    public function getPeriodos($idCarrera, Request $request)
{
    $query = Periodo::where('idcarrera', $idCarrera);

    // Solo aplicar filtros si se solicitan (para periodo anterior)
    if ($request->has('cuatrimestre')) {
        $query->where('cuatrimestre', $request->cuatrimestre);
    }

    if ($request->has('grupo')) {
        $query->where('grupo', $request->grupo);
    }

    return response()->json($query->get());
}

    public function getCuatrimestres($idCarrera)
    {
        return response()->json(
            Periodo::where('idcarrera', $idCarrera)
                ->distinct()
                ->orderBy('cuatrimestre')
                ->pluck('cuatrimestre')
        );
    }

    public function getGrupos($idCarrera)
    {
        return response()->json(
            Periodo::where('idcarrera', $idCarrera)
                ->distinct()
                ->orderBy('grupo')
                ->pluck('grupo')
        );
    }

    public function getAlumnos($idPeriodo)
    {
        return response()->json(
            Asignacion::where('idperiodo', $idPeriodo)
                ->with('alumno')
                ->get()
                ->pluck('alumno')
        );
    }

    public function getAlumnosSinAsignar($idCarrera)
    {
        return response()->json(
            Alumno::where('idcarrera', $idCarrera)
                ->whereDoesntHave('asignaciones')
                ->get()
        );
    }

    public function asignar(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->alumnos as $idAlumno) {
                Asignacion::updateOrCreate(
                    ['idalumno' => $idAlumno],
                    ['idperiodo' => $request->nuevo_periodo]
                );
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}