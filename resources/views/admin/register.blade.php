<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center text-black-500"> Registro de Administrador </h1>

     <!-- Formulario de Registro -->
    <form method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingrese su nombre completo" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- ApellidoP -->
        <div class="mb-4">
            <label for="apellidoP" class="block text-sm font-medium text-gray-700">Apellido Paterno:</label>
            <input type="text" name="apellidoP" placeholder="Ingrese su apellido" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- ApellidoM -->
        <div class="mb-4">
            <label for="apellidoM" class="block text-sm font-medium text-gray-700">Apellido Materno:</label>
            <input type="text" name="apellidoM" placeholder="Ingrese su apellido" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Correo -->
        <div class="mb-4">
            <label for="correo" class="block text-sm font-medium text-gray-700">Correo electrónico:</label>
            <input type="email" name="correo" placeholder="Ingrese su correo electrónico" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Alias -->
        <div class="mb-4">
            <label for="alias" class="block text-sm font-medium text-gray-700">Alias:</label>
            <input type="text" name="alias" placeholder="Ingrese un alias único" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto:</label>
            <div class="mt-1 flex items-center">
                <div class="relative">

        <!-- Imagen de vista previa -->
            <img id="foto-preview" src="https://via.placeholder.com/100" alt="Vista previa de la foto" class="w-16 h-16 rounded-full object-cover">
            
        <!-- Input de archivo oculto -->
            <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="mostrarVistaPrevia(event)">
            
        <!-- Botón personalizado -->
            <label for="foto" class="absolute bottom-0 right-0 bg-blue-500 text-white p-1 rounded-full cursor-pointer hover:bg-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
     </svg>
    </label>
    </div>
            <p class="ml-4 text-sm text-gray-500">Haz clic para subir una foto.</p>
    </div>
    </div>

        <!-- Nivel de Acceso -->
        <div class="mb-4">
            <label for="nivel" class="block text-sm font-medium text-gray-700">Nivel de Acceso:</label>
            <select name="nivel" id="nivel" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="" disabled selected>Seleccione su nivel de acceso</option>
                <option value="1">Nivel 1</option>
                <option value="2">Nivel 2</option>
                <option value="3">Nivel 3</option>
            </select>
        </div>


        <!-- Contraseña -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingresa una contraseña segura" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Botones registrar -->
        <div class="flex items-center justify-between">
        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancelar</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Registrar</button>
        </div>
    </form>
</div>
        <!-- Script para la vista previa de la foto -->
        <script>
            function mostrarVistaPrevia(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('foto-preview').src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
</body>
</html>