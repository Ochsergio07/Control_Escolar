<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<style>
    .titulo-con-fondo {
        font-size: 1.5rem; /* Tamaño del texto */
        font-weight: bold; /* Negrita */
        text-align: center; /* Centrado */
        color: white; /* Color del texto */
        background-color: rgba(156,41,41,0.884); /* Fondo rojo */
        padding: 0.5rem 1rem; /* Padding interno */
        border-radius: 0.5rem; /* Bordes redondeados */
        margin-left: -2rem; /* Estira el fondo hacia la izquierda */
        margin-right: -2rem; /* Estira el fondo hacia la derecha */
        margin-top: -2rem; /* Mueve el título hacia arriba */
        margin-bottom: 1.5rem; /* Margen inferior */
        font-family: 'Roboto', sans-serif; /* Fuente para títulos */
    }
</style>

<style>
    /* Estilos personalizados */
    body {
        font-family: 'Crimson Text', serif; /* Fuente para textos */
    }

    button {
        background-color: rgba(4, 4, 68, 0.774); /* Color de botón */
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: rgba(4, 4, 68, 0.9); /* Efecto hover */
    }
</style>

<style>
    .logo-empresa {
        width: 6rem; /* Tamaño del logo */
        position: absolute; /* Posicionamiento absoluto */
        top: 5rem; /* Mueve el logo hacia arriba y abajo*/
        left: 23rem; /* Mueve el logo  */
    }
</style>

        <!-- Cambia a "justify-start" para alinear a la izquierda -->
        <div class="flex justify-start">

        <!-- Logo de la empresa en la esquina superior izquierda -->
        <img src="{{ asset('imagenes/logo cuv.png') }}" alt="Logo del Centro Universitario Valladolid" class="logo-empresa">

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="titulo-con-fondo">Inicia Sesión</h1>

    <!-- Formulario de Registro -->
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

    <!-- Alias -->
    <div class="mb-4">
            <label for="alias" class="block text-[17px]  font-medium text-gray-700">Alias:</label>
            <input type="text" name="alias" placeholder="Ingrese su alias" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    </div>

     <!-- Contraseña -->
    <div class="mb-6">
            <label class="block text-[17px] font-medium text-gray-700">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingrese su contraseña" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Boton iniciar sesion -->
        <div class="flex items-center justify-between">
       <button submit class=" text-white px-4 py-2 rounded-md w-full">Iniciar Sesión</button>
        </div>
    </form>
    </div>
</body>
</html>