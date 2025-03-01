<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center text-black-500">Iniciar Sesión</h1>

    <!-- Formulario de Registro -->
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

    <!-- Alias -->
    <div class="mb-4">
            <label for="alias" class="block text-sm font-medium text-gray-700">Alias:</label>
            <input type="text" name="alias" placeholder="Ingrese su alias" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    </div>

     <!-- Contraseña -->
    <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingrese su contraseña" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Boton iniciar sesion -->
        <div class="flex items-center justify-between">
       <button submit class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Iniciar Sesión</button>
        </div>
    </form>
    </div>
</body>
</html>