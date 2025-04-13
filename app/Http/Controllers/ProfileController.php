<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumno;
use App\Models\Docente;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $nombre = $request->input('nombre');
        $password = $request->input('password');

        $alumno = Alumno::where('email', $nombre)->first();
        if ($alumno && Hash::check($password, $alumno->password)) {

            session(['user' => $alumno, 'role' => 'alumno']);
            return redirect()->intended('menu');
        }

        $docente = Docente::where('nombre', $nombre)->first();
        if ($docente && Hash::check($password, $docente->password)) {

            session(['user' => $docente, 'role' => 'docente']);
            return redirect()->intended('menu');
        }

        return back()->withErrors(['nombre' => 'Nombre o contraseña incorrectos']);
    }

    public function logout()
    {
        session()->forget(['user', 'role']);
        return redirect('/');
    }
}
