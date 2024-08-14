<?php
require_once 'ClientesLogic.php'; // Incluye la lógica

$clientesLogic = new ClientesLogic();
header('Content-Type: application/json');

// Leer todos los clientes
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'readAll') {
    $clientes = $clientesLogic->getAllClientes();
    echo json_encode($clientes);
    exit;
}

// Crear o actualizar un cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id']) && !empty($data['id'])) {
        // Actualizar cliente
        $clientesLogic->updateCliente($data['id'], $data['name'], $data['lastname']);
        echo json_encode(['message' => 'Cliente actualizado exitosamente']);
    } else {
        // Crear cliente
        $id = $clientesLogic->createCliente($data['name'], $data['lastname']);
        echo json_encode(['message' => 'Cliente creado exitosamente', 'id' => $id]);
    }
    exit;
}

// Eliminar un cliente
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['id'])) {
        $clientesLogic->deleteCliente($data['id']);
        echo json_encode(['message' => 'Cliente eliminado exitosamente']);
    } else {
        echo json_encode(['error' => 'ID no proporcionado']);
    }
    exit;
}

// Leer un cliente específico
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'read' && isset($_GET['id'])) {
    $cliente = $clientesLogic->getClienteById($_GET['id']);
    if ($cliente) {
        echo json_encode($cliente);
    } else {
        echo json_encode(['error' => 'Cliente no encontrado']);
    }
    exit;
}
?>
