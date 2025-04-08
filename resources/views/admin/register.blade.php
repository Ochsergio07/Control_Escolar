<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<style>
    .captcha-container {
        margin: 1rem 0;
        padding: 1rem;
        background: #f5f5f5;
        border-radius: 8px;
        display: inline-block;
    }
    
    .captcha-code {
        font-family: 'Courier New', monospace;
        font-size: 1.5rem;
        letter-spacing: 0.5rem;
        padding: 0.5rem;
        background: #fff;
        border: 2px dashed #ccc;
        display: inline-block;
        margin-right: 1rem;
    }
    
    .captcha-input {
        padding: 0.5rem;
        font-size: 1rem;
        width: 150px;
        margin-top: 0.5rem;
    }
    
    .btn-captcha {
        background-color: #4CAF50 !important;
        margin-left: 0.5rem;
    }
    
    .btn-captcha:hover {
        background-color: #45a049 !important;
    }
</style>

<style>
    .titulo-con-fondo {
        font-size: 2rem; /* Tamaño del texto */
        font-weight: bold; /* Negrita */
        text-align: center; /* Centrado */
        color: white; /* Color del texto */
        background-color: rgba(156,41,41,0.884); /* Fondo rojo */
        padding: 1rem 2rem; /* Padding interno */
        border-radius: 0.5rem; /* Bordes redondeados */
        margin-left: -2rem; /* Estira el fondo hacia la izquierda */
        margin-right: -2rem; /* Estira el fondo hacia la derecha */
        margin-top: -2rem; /* Mueve el título hacia arriba */
        margin-bottom: 1.5rem; /* Margen inferior */
        font-family: 'Roboto', sans-serif; /* Fuente para títulos */
    }

    .form-container {
        max-width: 800px; /* Ancho máximo del contenedor */
        width: 100%; /* Ocupa todo el ancho disponible */
        padding: 2rem; /* Padding interno */
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Dos columnas */
        gap: 1rem; /* Espacio entre los campos */
    }

    .full-width {
        grid-column: span 2; /* Ocupa dos columnas */
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
        top: 1rem; /* Mueve el logo hacia arriba y abajo*/
        left: 5rem; /* Mueve el logo  */
    }
</style>

        <!-- Cambia a "justify-start" para alinear a la izquierda -->
        <div class="flex justify-start">
        <!-- Logo de la empresa en la esquina superior izquierda -->
        <img src="{{ asset('imagenes/logo cuv.png') }}" alt="Logo del Centro Universitario Valladolid" class="logo-empresa">
        </div>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg form-container">
    <h1 class="titulo-con-fondo"> Registro de Administrador </h1>

     <!-- Formulario de Registro -->
    <form method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data" class="form-grid">
        @csrf

        <!-- Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block text-[17px] font-medium text-black">Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingrese su nombre completo" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- ApellidoP -->
        <div class="mb-4">
            <label for="apellidoP" class="block text-[17px] font-medium text-black">Apellido Paterno:</label>
            <input type="text" name="apellidoP" placeholder="Ingrese su apellido" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- ApellidoM -->
        <div class="mb-4">
            <label for="apellidoM" class="block text-[17px] font-medium text-black">Apellido Materno:</label>
            <input type="text" name="apellidoM" placeholder="Ingrese su apellido" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Correo -->
        <div class="mb-4">
            <label for="correo" class="block text-[17px] font-medium text-black">Correo electrónico:</label>
            <input type="email" name="correo" placeholder="Ingrese su correo electrónico" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Alias -->
        <div class="mb-4">
            <label for="alias" class="block text-[17px] font-medium text-black">Alias:</label>
            <input type="text" name="alias" placeholder="Ingrese un alias único" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label for="foto" class="block text-[17px] font-medium text-black">Foto:</label>
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
            <label for="nivel" class="block text-[17px] font-medium text-black">Nivel de Acceso:</label>
            <select name="nivel" id="nivel" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="" disabled selected>Seleccione su nivel de acceso</option>
                <option value="1">Nivel 1</option>
                <option value="2">Nivel 2</option>
                <option value="3">Nivel 3</option>
            </select>
        </div>


        <!-- Contraseña -->
        <div class="mb-4">
            <label for="password" class="block text-[17px] font-medium text-black">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingresa una contraseña segura" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Agrega esto antes del botón de Registrar -->
<div class="captcha-container">
    <div class="mb-4">
        <label class="block text-[17px] font-medium text-gray-700">Verificación de Seguridad</label>
        <div class="mt-2 flex items-center">
            <span id="captchaRegistro" class="captcha-code"></span>
            <button type="button" onclick="generarCaptcha('registro')" class="btn-captcha text-white px-3 py-2 rounded-md">
                ↻ Actualizar
            </button>
        </div>
        <input type="text" id="captchaInputRegistro" class="captcha-input mt-2" placeholder="Ingrese el código mostrado" required>
    </div>
</div>

        <!-- Botones registrar -->
        <div class="flex items-center justify-between full-width">
        <button type="button" class="text-white px-4 py-2 rounded-md">Cancelar</button>
        <button type="submit" class="text-white px-4 py-2 rounded-md">Registrar</button>
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

<script>
    // Generar CAPTCHA inicial
    let captchaRegistro = '';
    let captchaAsignacion = '';

    function generarCaptcha(tipo) {
        const numeros = '0123456789';
        let codigo = '';
        for(let i = 0; i < 4; i++) {
            codigo += numeros[Math.floor(Math.random() * numeros.length)];
        }
        
        if(tipo === 'registro') {
            captchaRegistro = codigo;
            document.getElementById('captchaRegistro').textContent = codigo;
        } else {
            captchaAsignacion = codigo;
            document.getElementById('captchaAsignacion').textContent = codigo;
        }
    }

    // Generar CAPTCHA al cargar la página
    window.onload = function() {
        generarCaptcha('registro');
        generarCaptcha('asignacion');
    }

    // Validación genérica
    function validarCaptcha(tipo) {
        const input = tipo === 'registro' 
            ? document.getElementById('captchaInputRegistro').value
            : document.getElementById('captchaInputAsignacion').value;
            
        const codigoCorrecto = tipo === 'registro' ? captchaRegistro : captchaAsignacion;

        if(input !== codigoCorrecto) {
            alert('El código de verificación es incorrecto. Por favor intente de nuevo.');
            generarCaptcha(tipo);
            return false;
        }
        return true;
    }
     // Agrega esto al final del script existente:
     document.querySelector('form[action="{{ route('admin.register') }}"]').addEventListener('submit', function(e) {
        if(!validarCaptcha('registro')) {
            e.preventDefault();
            // Opcional: Mostrar error en un div específico
            document.getElementById('captchaError').innerHTML = 'Código incorrecto, intente nuevamente';
            generarCaptcha('registro'); // Regenerar CAPTCHA
        }
    });
</script>
</body>
</html>