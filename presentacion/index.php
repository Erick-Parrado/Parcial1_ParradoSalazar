<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>CRUD de Clientes</title>
</head>
<body>
    <h1>CRUD de Clientes</h1>

    <!-- Formulario para crear o actualizar clientes -->
    <form id="clienteForm">
        <h2>Agregar/Actualizar Cliente</h2>
        <input type="hidden" id="clienteId" name="clienteId">
        <label for="nombreCliente">Nombre:</label>
        <input type="text" id="nombreCliente" name="nombreCliente" required>
        <label for="apellidoCliente">Apellido:</label>
        <input type="text" id="apellidoCliente" name="apellidoCliente" required>
        <button type="submit">Guardar Cliente</button>
    </form>

    <!-- Tabla para listar clientes -->
    <h2>Lista de Clientes</h2>
    <table id="clientesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se llenarán los datos con JavaScript -->
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            loadClientes();

            document.getElementById('clienteForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('clienteId').value;
                const name = document.getElementById('nombreCliente').value;
                const lastname = document.getElementById('apellidoCliente').value;
                const action = id ? 'update' : 'create';

                fetch('clientesHandler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id, name, lastname }),
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadClientes();
                    document.getElementById('clienteForm').reset();
                });
            });
        });

        function loadClientes() {
            fetch('clientesHandler.php?action=readAll')
                .then(response => response.json())
                .then(clientes => {
                    const tableBody = document.getElementById('clientesTable').getElementsByTagName('tbody')[0];
                    tableBody.innerHTML = '';
                    clientes.forEach(cliente => {
                        const row = tableBody.insertRow();
                        row.insertCell().textContent = cliente.id;
                        row.insertCell().textContent = cliente.name;
                        row.insertCell().textContent = cliente.lastname;

                        const actionsCell = row.insertCell();
                        actionsCell.innerHTML = `
                            <button onclick="editCliente(${cliente.id})">Editar</button>
                            <button onclick="deleteCliente(${cliente.id})">Eliminar</button>
                        `;
                    });
                });
        }

        function editCliente(id) {
            fetch(`clientesHandler.php?action=read&id=${id}`)
                .then(response => response.json())
                .then(cliente => {
                    document.getElementById('clienteId').value = cliente.id;
                    document.getElementById('nombreCliente').value = cliente.name;
                    document.getElementById('apellidoCliente').value = cliente.lastname;
                });
        }

        function deleteCliente(id) {
            fetch('clientesHandler.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                loadClientes();
            });
        }
    </script>
</body>
</html>
