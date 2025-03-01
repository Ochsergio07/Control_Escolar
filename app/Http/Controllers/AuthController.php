<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // Procesar el registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidoP' => 'required|string|max:50',
            'apellidoM' => 'required|string|max:50',
            'alias' => 'required|string|max:50|unique:admin',
            'password' => 'required|string|max:50',
            'correo' => 'required|string|email|max:256|unique:admin',
            'nivel' => 'required|integer|in:1,2,3', // Validar que el nivel sea 1, 2 o 3
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen y tenga un tamaño máximo de 2MB
        ]);

        // Subir la foto si se proporciona
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public'); // Guardar la foto en la carpeta "storage/app/public/fotos"
        }

        // Crear un nuevo administrador
        $admin = new Admin();
        $admin->nombre = $request->nombre;
        $admin->apellidoP = $request->apellidoP;
        $admin->apellidoM = $request->apellidoM;
        $admin->alias = $request->alias;
        $admin->password = Hash::make($request->password);
        $admin->correo = $request->correo;
        $admin->nivel = $request->nivel;
        $admin->foto = $fotoPath; // Guardar la ruta de la foto
        $admin->save();

        return redirect()->route('admin.login')->with('success', 'Registro exitoso!');
    }

    // Mostrar formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'alias' => 'required|string|max:50',
            'password' => 'required|string|max:50',
        ]);

        // Buscar al administrador por su alias
        $admin = Admin::where('alias', $request->alias)->first();

        // Verificar la contraseña
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Inicio de sesión exitoso
            session(['admin' => $admin]); // Guardar el administrador en la sesión
            return redirect()->route('admin.dashboard')->with('success', 'Inicio de sesión exitoso!');
        }

        // Credenciales incorrectas
        return back()->withErrors(['alias' => 'Credenciales incorrectas']);
    }
}