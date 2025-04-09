<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Escolar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen text-gray-900 font-sans p-4">
    <style>
        <style>
    /* Estilo para el modal de CAPTCHA */
    #captchaModal {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    /* Estilo para la caja de CAPTCHA */
    #captchaBox {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transform: scale(0.95);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
        max-width: 400px;
        width: 100%;
    }

    /* Estilo para el título del modal */
    #captchaBox h2 {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin-bottom: 16px;
    }

    /* Estilo para los mensajes de instrucciones */
    #captchaBox p {
        font-size: 16px;
        color: #555;
        margin-bottom: 20px;
    }

    /* Estilo para el código del CAPTCHA */
    #captchaCode {
        font-weight: 700;
        font-size: 18px;
        color: #007bff;
        border-bottom: 2px solid #007bff;
        padding-bottom: 4px;
    }

    /* Estilo para el campo de entrada */
    #captchaInput {
        border: 2px solid #ddd;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 16px;
        width: 100%;
        margin-bottom: 16px;
        transition: border-color 0.3s ease;
    }

    #captchaInput:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Estilo para los botones */
    #captchaBox button {
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    #captchaBox .confirm-btn:hover {
    background-color: rgb(202, 20, 20); /* mismo rojo de fondo */
}

    /* Botón de confirmar */
    #captchaBox .confirm-btn {
        background-color:rgb(202, 20, 20);
        color: white;
        margin-right: 10px;
    }

    /* Botón de cancelar */
    #captchaBox .cancel-btn {
        background-color: #dc3545;
        color: white;
    }

    /* Animación de entrada */
    #captchaBox.scale-100 {
        transform: scale(1);
        opacity: 1;
    }

    #captchaBox.scale-95 {
        transform: scale(0.95);
        opacity: 0;
    }
</style>

    </style>

    <div class="flex justify-start mb-4">
        <div class="w-36 h-36 bg-contain bg-no-repeat bg-center" style="background-image: url('images/logo.png');"></div>
    </div>

    <h3 class="text-5xl font-semibold text-center text-red-600 mb-3 -mt-12">Campus Universitario</h3>
    <h1 class="text-6xl font-bold text-center text-blue-800 mb-3 -mt-1">Centro Universitario de Valladolid</h1>
    <h2 class="text-3xl font-extrabold text-center text-white bg-red-600 shadow-md py-2 mb-6 rounded">Licenciaturas</h2>

    <div class="overflow-x-auto flex justify-center mb-6">
        <table id="carreraTable" class="min-w-full divide-y divide-gray-200 bg-white shadow-lg rounded-lg">
            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Nombre de la Carrera</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">RVOE</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($carreras as $carrera)
                <tr data-id="{{ $carrera->idcarrera }}">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $carrera->nombre }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $carrera->rvoe }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button onclick="editarFila(this)" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mr-2">Editar</button>
                        <button onclick="eliminarFila(this)" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mb-4">
        <button onclick="agregarFila()" class="bg-green-600 hover:bg-green-800 text-white px-6 py-3 rounded-xl shadow-lg transition duration-300 transform hover:scale-105">
            ➕ Agregar carrera
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            cargarCarrera();
        });

        function cargarCarrera() {
            fetch('/obtener-carrera')
                .then(response => response.json())
                .then(data => {
                    var table = document.getElementById('carreraTable').getElementsByTagName('tbody')[0];
                    table.innerHTML = '';
                    data.forEach(carrera => {
                        var newRow = table.insertRow();
                        newRow.setAttribute('data-id', carrera.idcarrera);
                        newRow.innerHTML = `
                            <td class="px-6 py-4 whitespace-nowrap">${carrera.nombre}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${carrera.rvoe}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="editarFila(this)" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mr-2">Editar</button>
                                <button onclick="eliminarFila(this)" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Eliminar</button>
                            </td>
                        `;
                    });
                });
        }

        function agregarFila() {
            var table = document.getElementById('carreraTable').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow();
            newRow.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap"><input type="text" value="" class="border rounded w-full px-2 py-1"></td>
                <td class="px-6 py-4 whitespace-nowrap"><input type="text" value="" class="border rounded w-full px-2 py-1"></td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <button onclick="guardarFila(this)" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mr-2">Guardar</button>
                    <button onclick="eliminarFila(this)" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Cancelar</button>
                </td>
            `;
        }

        function guardarFila(button) {
            var row = button.parentNode.parentNode;
            var cells = row.getElementsByTagName('td');
            var data = {
                nombre: cells[0].querySelector('input').value,
                rvoe: cells[1].querySelector('input').value
            };

            fetch('/guardar-carrera', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ carrera: [data] })
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.success) {
                    alert("Carrera guardada con éxito");
                    cargarCarrera();
                } else {
                    alert("Error al guardar");
                }
            })
            .catch(error => console.error("Error en la solicitud:", error));
        }

        function editarFila(button) {
            var row = button.parentNode.parentNode;
            var idcarrera = row.getAttribute('data-id');
            var cells = row.getElementsByTagName('td');

            cells[0].innerHTML = `<input type="text" value="${cells[0].innerText}" class="border rounded w-full px-2 py-1">`;
            cells[1].innerHTML = `<input type="text" value="${cells[1].innerText}" class="border rounded w-full px-2 py-1">`;
            cells[2].innerHTML = `
                <button onclick="guardarEdicion(this, ${idcarrera})" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mr-2">Guardar</button>
                <button onclick="cargarCarrera()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Cancelar</button>
            `;
        }

        function guardarEdicion(button, idcarrera) {
            var row = button.parentNode.parentNode;
            var cells = row.getElementsByTagName('td');
            var data = {
                nombre: cells[0].querySelector('input').value,
                rvoe: cells[1].querySelector('input').value
            };

            fetch(`/editar-carrera/${idcarrera}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.success) {
                    alert("Carrera editada con éxito");
                    cargarCarrera();
                } else {
                    alert("Error al editar");
                }
            })
            .catch(error => console.error("Error en la solicitud:", error));
        }

        let filaParaEliminar = null;
        let captchaGenerado = null;

        function eliminarFila(button) {
            filaParaEliminar = button.closest("tr");
            captchaGenerado = Math.floor(1000 + Math.random() * 9000);

            document.getElementById("captchaCode").textContent = captchaGenerado;
            document.getElementById("captchaInput").value = "";

            const modal = document.getElementById("captchaModal");
            const box = document.getElementById("captchaBox");

            modal.classList.remove("hidden");

            setTimeout(() => {
                box.classList.remove("scale-95", "opacity-0");
                box.classList.add("scale-100", "opacity-100");
            }, 10);
        }

        function cerrarCaptcha() {
            const modal = document.getElementById("captchaModal");
            const box = document.getElementById("captchaBox");

            box.classList.remove("scale-100", "opacity-100");
            box.classList.add("scale-95", "opacity-0");

            setTimeout(() => {
                modal.classList.add("hidden");
                filaParaEliminar = null;
                captchaGenerado = null;
            }, 300);
        }

        function confirmarCaptcha() {
            const input = document.getElementById("captchaInput").value;
            if (input !== captchaGenerado.toString()) {
                alert("Código incorrecto. Intenta de nuevo.");
                return;
            }

            const idcarrera = filaParaEliminar.getAttribute("data-id");

            fetch(`/eliminar-carrera/${idcarrera}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.success) {
                    alert("Carrera eliminada con éxito");
                    cargarCarrera();
                } else {
                    alert("Error al eliminar");
                }
                cerrarCaptcha();
            })
            .catch(error => {
                console.error("Error en la solicitud:", error);
                cerrarCaptcha();
            });
        }
    </script>

    <!-- Modal de captcha -->
    <div id="captchaModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div id="captchaBox" class="bg-white rounded-lg shadow-lg p-6 scale-95 opacity-0 transition-transform duration-300">
            <h2 class="text-2xl font-bold mb-4">Confirmar eliminación</h2>
            <p class="mb-4">Por favor ingresa el código para confirmar la eliminación de la carrera.</p>
            <div class="mb-4">
                <span class="font-semibold">Código:</span> <span id="captchaCode" class="text-blue-700"></span>
            </div>
            <input id="captchaInput" type="text" class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Ingresa el código">
            <div class="mt-4">
                <button onclick="confirmarCaptcha()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mr-2">Confirmar</button>
                <button onclick="cerrarCaptcha()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Cancelar</button>
            </div>
        </div>
    </div>
</body>
