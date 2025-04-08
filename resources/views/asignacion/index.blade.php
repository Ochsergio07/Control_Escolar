<!DOCTYPE html>
<html>
<head>
    <title>Asignación de Periodos</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
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
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: white;
            background-color: rgba(156,41,41,0.884);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            margin-left: -2rem;
            margin-right: -2rem;
            margin-top: -2rem;
            margin-bottom: 1.5rem;
            font-family: 'Roboto', sans-serif;
        }

        body {
            font-family: 'Crimson Text', serif;
            color: #000000;
        }

        button {
            background-color: rgba(4, 4, 68, 0.774);
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: rgba(4, 4, 68, 0.9);
        }

        .logo-empresa {
            width: 6rem;
            position: absolute;
            top: 1rem;
            left: 4rem;
        }

        .filter-section {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
            <div class="flex justify-start">
                <img src="{{ asset('imagenes/logo cuv.png') }}" alt="Logo del Centro Universitario Valladolid" class="logo-empresa">
            </div>

            <h1 class="titulo-con-fondo">Asignación de Alumnos</h1>

            <!-- Filtros -->
            <div class="filter-section">
                <!-- Selección de Carrera -->
                <div class="mb-4">
                    <label class="block text-[17px] font-medium text-gray-900">Carrera:</label>
                    <div class="mt-1 flex items-center gap-2">
                        <select id="selectCarrera" style="width: 330px;" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->idcarrera }}">{{ $carrera->nombre }}</option>
                            @endforeach
                        </select>
                        <button id="btnCargarFiltros" class="text-white px-4 py-2 rounded-md">Cargar Filtros</button>
                    </div>
                </div>

                <!-- Filtros Adicionales -->
                <div class="grid grid-cols-4 gap-4 mt-4">
                    <div>
                        <label class="block text-[17px] font-medium text-gray-900">Cuatrimestre:</label>
                        <select id="selectCuatrimestre" class="w-27 px-3 py-2 border border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[17px] font-medium text-gray-900">Grupo:</label>
                        <select id="selectGrupo" class="w-27 px-3 py-2 border border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="">Todos</option>
                        </select>
                    </div>
                </div>
                <button id="btnAplicarFiltros" class="mt-4 text-white px-4 py-2 rounded-md">Aplicar Filtros</button>
            </div>

            <!-- Periodo Anterior -->
            <div class="filter-section">
                <div class="mb-4">
                    <label class="block text-[17px] font-medium text-gray-900">Periodo Anterior:</label>
                    <div class="mt-1 flex items-center gap-2">
                        <select id="selectPeriodo" style="width: 300px;" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Seleccione un periodo</option>
                            <option value="sin_asignar">Sin asignar</option>
                        </select>
                        <button id="btnBuscarAlumnos" class="text-white px-4 py-2 rounded-md">Buscar Alumnos</button>
                    </div>
                </div>
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
                <tbody></tbody>
            </table>

            <!-- Nuevo Periodo -->
            <div class="filter-section">
                <div class="mb-4">
                    <label class="block text-[17px] font-medium text-gray-900">Nuevo Periodo:</label>
                    <div class="mt-1 flex items-center gap-2">
                        <select id="selectNuevoPeriodo" style="width: 300px;" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Seleccione un periodo</option>
                        </select>

                        <!-- Agrega esto antes del botón de Asignar -->
<div class="captcha-container">
    <div class="mb-4">
        <label class="block text-[17px] font-medium text-gray-700">Verificación de Seguridad</label>
        <div class="mt-2 flex items-center">
            <span id="captchaAsignacion" class="captcha-code"></span>
            <button type="button" onclick="generarCaptcha('asignacion')" class="btn-captcha text-white px-3 py-2 rounded-md">
                ↻ Actualizar
            </button>
        </div>
        <input type="text" id="captchaInputAsignacion" class="captcha-input mt-2" placeholder="Ingrese el código mostrado" required>
    </div>
</div>

                        <button id="btnAsignar" class="text-white px-4 py-2 rounded-md">Asignar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cargar Filtros
            $('#btnCargarFiltros').click(function() {
    const idCarrera = $('#selectCarrera').val();
    
    // Cargar filtros y periodos
    cargarFiltros(idCarrera);
    
    // Cargar TODOS los periodos para nuevo periodo
    $.get(`/asignacion/periodos/${idCarrera}`, function(data) {
        $('#selectNuevoPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
        data.forEach(periodo => {
            $('#selectNuevoPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
        });
    });
});

            // Función para cargar filtros
            function cargarFiltros(idCarrera) {
                // Cargar cuatrimestres
                $.get(`/asignacion/cuatrimestres/${idCarrera}`, function(data) {
                    $('#selectCuatrimestre').empty().append('<option value="">Todos</option>');
                    data.forEach(cuatrimestre => {
                        $('#selectCuatrimestre').append(`<option value="${cuatrimestre}">${cuatrimestre}</option>`);
                    });
                });

                // Cargar grupos
                $.get(`/asignacion/grupos/${idCarrera}`, function(data) {
                    $('#selectGrupo').empty().append('<option value="">Todos</option>');
                    data.forEach(grupo => {
                        $('#selectGrupo').append(`<option value="${grupo}">${grupo}</option>`);
                    });
                });
            }

            $('#btnAplicarFiltros').click(function() {
    const idCarrera = $('#selectCarrera').val();
    
    // Solo actualizar periodo anterior
    $.get(`/asignacion/periodos/${idCarrera}`, {
        cuatrimestre: $('#selectCuatrimestre').val(),
        grupo: $('#selectGrupo').val()
    }, function(data) {
        $('#selectPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
        $('#selectPeriodo').append('<option value="sin_asignar">Sin asignar</option>');
        data.forEach(periodo => {
            $('#selectPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
        });
    });
});

            // Función para cargar periodos
function cargarPeriodos(idCarrera) {
    const cuatrimestre = $('#selectCuatrimestre').val();
    const grupo = $('#selectGrupo').val();

    // Cargar periodos FILTRADOS para periodo anterior
    $.get(`/asignacion/periodos/${idCarrera}`, {
        cuatrimestre: cuatrimestre,
        grupo: grupo
    }, function(data) {
        $('#selectPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
        $('#selectPeriodo').append('<option value="sin_asignar">Sin asignar</option>');
        data.forEach(periodo => {
            $('#selectPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
        });
    });

    // Cargar TODOS los periodos para nuevo periodo
    $.get(`/asignacion/periodos/${idCarrera}`, function(data) {
        $('#selectNuevoPeriodo').empty().append('<option value="">Seleccione un periodo</option>');
        data.forEach(periodo => {
            $('#selectNuevoPeriodo').append(`<option value="${periodo.idperiodo}">${periodo.nombre}</option>`);
        });
    });
}

            // Buscar alumnos
            $('#btnBuscarAlumnos').click(function() {
                const idPeriodo = $('#selectPeriodo').val();
                const idCarrera = $('#selectCarrera').val();

                if (idPeriodo === "sin_asignar") {
                    $.get(`/asignacion/alumnos-sin-asignar/${idCarrera}`, function(data) {
                        mostrarAlumnos(data);
                    });
                } else {
                    $.get(`/asignacion/alumnos/${idPeriodo}`, function(data) {
                        mostrarAlumnos(data);
                    });
                }
            });

            // Mostrar alumnos en tabla
            function mostrarAlumnos(alumnos) {
                $('#tablaAlumnos tbody').empty();
                alumnos.forEach(alumno => {
                    $('#tablaAlumnos tbody').append(`
                        <tr>
                            <td class="py-2 px-4 border-b"><input type="checkbox" class="chkAlumno" value="${alumno.idalumno}"></td>
                            <td class="py-2 px-4 border-b">${alumno.nombre}</td>
                            <td class="py-2 px-4 border-b">${alumno.apellidoP} ${alumno.apellidoM}</td>
                        </tr>
                    `);
                });
            }


            // Asignar alumnos
            $('#btnAsignar').click(function() {
                if(!validarCaptcha('asignacion')) {
        $('#captchaErrorAsignacion').text('Código incorrecto, intente nuevamente');
        generarCaptcha('asignacion');
        return false;
    }
                const alumnos = $('.chkAlumno:checked').map((i, el) => el.value).get();
                const nuevoPeriodo = $('#selectNuevoPeriodo').val();

                if (!alumnos.length || !nuevoPeriodo) {
                    alert('Seleccione al menos un alumno y un periodo válido');
                    return;
                }

                $.post('/asignacion/asignar', {
                    alumnos: alumnos,
                    nuevo_periodo: nuevoPeriodo,
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    if (response.success) {
                        alert('Asignación exitosa!');
                        $('#btnBuscarAlumnos').click();
                    }
                }).fail(function(error) {
                    alert('Error: ' + error.responseJSON.message);
                });
            });
        });
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
</script>
<script>
    // Esperar a que todo el documento esté listo
    $(function() {
        // Generar primer CAPTCHA
        generarCaptcha('asignacion');
        
        // Configurar evento para el botón de actualizar
        $('.btn-captcha').click(function() {
            const tipo = $(this).attr('onclick').match(/'(\w+)'/)[1];
            generarCaptcha(tipo);
        });
    });
</script>

</body>
</html>