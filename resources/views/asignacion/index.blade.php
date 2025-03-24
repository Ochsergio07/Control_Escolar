<!DOCTYPE html>
<html>
<head>
    <title>Asignación de Periodos</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<style>
    .titulo-con-fondo {
        font-size: 2rem; /* Tamaño del texto */
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
        top: 1rem; /* Mueve el logo hacia arriba y abajo*/
        left: 4rem; /* Mueve el logo  */
    }
</style>
        <!-- Cambia a "justify-start" para alinear a la izquierda -->
        <div class="flex justify-start">

            <!-- Logo de la empresa en la esquina superior izquierda -->
            <img src="{{ asset('imagenes/logo cuv.png') }}" alt="Logo del Centro Universitario Valladolid" class="logo-empresa">
        </div>

<body>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h1 class="titulo-con-fondo">Asignación de Alumnos</h1>
        
       <!-- Selección de Carrera -->
<div class="mb-6">
    <label class="block text-[17px] font-medium text-gray-700">Carrera:</label>
    <div class="mt-1 flex items-center">
    <select id="selectCarrera" style="width: 330px;" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        @foreach($carreras as $carrera)
            <option value="{{ $carrera->idcarrera }}">{{ $carrera->nombre }}</option>
        @endforeach
    </select>
    <div class="flex items-center justify-between">
    <button id="btnCargarPeriodos" class="ml-2 text-white px-4 py-2 rounded-md w-full">Buscar</button> <!-- Botón para cargar periodos -->
</div>
 </div>

<!-- Selección de Periodo Anterior -->
<div class="mb-6">
    <label class="block text-[17px] font-medium text-gray-700">Periodo Anterior:</label>
    <select id="selectPeriodo" style="width: 300px;" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        <option value="">Seleccione un periodo</option>
    </select>
    <button id="btnBuscar" class=" text-white px-4 py-2 rounded-md ml-2">Buscar Alumnos</button>
</div>

        <!-- Lista de Alumnos -->
        <table id="tablaAlumnos" class="min-w-full bg-white border border-gray-200 mb-6">
            <thead>
                <tr>
                    <th class="py-3 px-4 border-b text-left">Seleccionar</th>
                    <th class="py-3 px-4 border-b text-left">Nombre</th>
                    <th class="py-3 px-4 border-b text-left">Apellidos</th>
                </tr>
            </thead>

            <tbody>
                <!-- Los alumnos se cargarán aquí via AJAX -->
            </tbody>
        </table>

        <!-- Selección de Nuevo Periodo -->
        <div class="mb-6">
            <label class="block text-[17px] font-medium text-gray-700">Nuevo Periodo:</label>
            <select id="selectNuevoPeriodo" style="width: 300px;" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="">Seleccione un periodo</option>
            </select>
            <button id="btnAsignar" class="text-white px-4 py-2 rounded-md ml-2">Asignar</button>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // resources/views/asignacion/index.blade.php

$(document).ready(function() {
    // Cargar Periodos al hacer clic en "Buscar"
    $('#btnCargarPeriodos').click(function() {
        let idCarrera = $('#selectCarrera').val(); // Obtener el ID de la carrera seleccionada

        // Verificar que se haya seleccionado una carrera
        if (!idCarrera) {
            alert('Seleccione una carrera.');
            return;
        }

        // Hacer la petición AJAX para obtener los periodos
        $.get(`/asignacion/periodos/${idCarrera}`, function(data) {
            // Limpiar y cargar los periodos en el listbox
            $('#selectPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
            $('#selectNuevoPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
            data.forEach(periodo => {
                $('#selectPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
                $('#selectNuevoPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
            });
        }).fail(function(error) {
            alert('Error al cargar los periodos: ' + error.responseJSON.message);
        });
    });
});

            // Cargar Periodos al hacer clic en "Buscar"
$('#btnCargarPeriodos').click(function() {
    let idCarrera = $('#selectCarrera').val();
    $.get(`/asignacion/periodos/${idCarrera}`, function(data) {
        $('#selectPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
        $('#selectNuevoPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
        data.forEach(periodo => {
            $('#selectPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
            $('#selectNuevoPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
        });
    });
});

            // Buscar Alumnos
            $('#btnBuscar').click(function() {
                let idPeriodo = $('#selectPeriodo').val();
                $.get(`/asignacion/alumnos/${idPeriodo}`, function(data) {
                    $('#tablaAlumnos tbody').empty();
                    data.forEach(alumno => {
                        $('#tablaAlumnos tbody').append(`
                            <tr>
                                <td><input type="checkbox" class="chkAlumno" value="${alumno.idalumno}"></td>
                                <td>${alumno.nombre}</td>
                                <td>${alumno.apellidoP} ${alumno.apellidoM}</td>
                            </tr>
                        `);
                    });
                });
            });

           
$('#btnAsignar').click(function() {
    let alumnos = [];
    $('.chkAlumno:checked').each(function() {
        alumnos.push($(this).val());
    });

    let nuevoPeriodo = $('#selectNuevoPeriodo').val();

    if (alumnos.length === 0) {
        alert('Seleccione al menos un alumno.');
        return;
    }

    if (!nuevoPeriodo) {
        alert('Seleccione un nuevo periodo.');
        return;
    }

    $.post('/asignacion/asignar', {
        alumnos: alumnos,
        nuevo_periodo: nuevoPeriodo,
        _token: '{{ csrf_token() }}'
    }, function(response) {
        if (response.success) {
            alert(response.message);
            // Recargar la lista de alumnos
            $('#btnBuscar').click();
        } else {
            alert(response.message);
        }
    }).fail(function(error) {
        alert('Error de conexión: ' + error.responseJSON.message);
    });
});
    </script>
</body>
</html>