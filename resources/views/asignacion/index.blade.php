<!DOCTYPE html>
<html>
<head>
    <title>Asignación de Periodos</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1>Asignación de Alumnos</h1>
        
       <!-- Selección de Carrera -->
<div class="form-group">
    <label>Carrera:</label>
    <select id="selectCarrera" class="form-control" style="width: 300px;">
        @foreach($carreras as $carrera)
            <option value="{{ $carrera->idcarrera }}">{{ $carrera->nombre }}</option>
        @endforeach
    </select>
    <button id="btnCargarPeriodos" class="btn btn-primary">Buscar</button> <!-- Botón para cargar periodos -->
</div>

<!-- Selección de Periodo Anterior -->
<div class="form-group">
    <label>Periodo Anterior:</label>
    <select id="selectPeriodo" class="form-control" style="width: 300px;">
        <option value="">Seleccione un periodo</option>
    </select>
    <button id="btnBuscar" class="btn btn-primary">Buscar Alumnos</button>
</div>

        <!-- Lista de Alumnos -->
        <table id="tablaAlumnos" class="table">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los alumnos se cargarán aquí via AJAX -->
            </tbody>
        </table>

        <!-- Selección de Nuevo Periodo -->
        <div class="form-group">
            <label>Nuevo Periodo:</label>
            <select id="selectNuevoPeriodo" class="form-control" style="width: 300px;">
                <option value="">Seleccione un periodo</option>
            </select>
            <button id="btnAsignar" class="btn btn-success">Asignar</button>
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