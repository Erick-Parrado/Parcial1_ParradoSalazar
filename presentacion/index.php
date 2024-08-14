<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
 <?php
    // Configuración de la conexión
    $host = "localhost";
    $user = "root";
    $password = ""; // Cambia si tienes una contraseña
    $dbname = "lavendida";

    // Conectar a la base de datos
    $enlace = mysqli_connect($host, $user, $password, $dbname);

    // Verificar la conexión
    if (!$enlace) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    echo "Conexión exitosa";

    // Cerrar la conexión
    mysqli_close($enlace);
    ?>

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
    </div>
</body>
</html>