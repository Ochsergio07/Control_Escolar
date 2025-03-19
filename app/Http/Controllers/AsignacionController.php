<?php
namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Periodo;
use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Asignacion;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller {
    public function index() {
        $carreras = Carrera::all();
        return view('asignacion.index', compact('carreras'));
    }

    public function getPeriodos($idCarrera) {
        // Obtener los periodos asociados a la carrera
        $periodos = Periodo::where('idcarrera', $idCarrera)->get();
    
        // Verificar si hay periodos
        if ($periodos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron periodos para esta carrera.'], 404);
        }
    
        return response()->json($periodos);
    }

    public function getAlumnos($idPeriodo) {
        // Obtener alumnos asignados al periodo a través de la tabla asignacion
        $alumnos = Asignacion::where('idperiodo', $idPeriodo)
            ->with('alumno') // Cargar la relación "alumno"
            ->get()
            ->pluck('alumno'); // Extraer los objetos alumno
    
        return response()->json($alumnos);
    }

    public function asignar(Request $request) {
        $alumnos = $request->alumnos;
        $nuevoPeriodo = $request->nuevo_periodo;
    
        // Validar que se seleccionó un periodo
        if (!$nuevoPeriodo) {
            return response()->json(['success' => false, 'message' => 'Seleccione un periodo válido.']);
        }
    
        DB::beginTransaction();
        try {
            foreach ($alumnos as $idAlumno) {
                // Actualizar o crear la asignación
                Asignacion::updateOrCreate(
                    ['idalumno' => $idAlumno], // Buscar por alumno
                    ['idperiodo' => $nuevoPeriodo] // Actualizar el periodo
                );
            }
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Asignación exitosa.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}