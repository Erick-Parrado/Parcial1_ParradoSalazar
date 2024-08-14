<?php
require_once 'ClientesLogic.php'; // Incluye la lógica de negocio

header('Content-Type: application/json');

$clientesLogic = new ClientesLogic();
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'create':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $clientesLogic->createCliente($data['name'], $data['lastname']);
        echo json_encode(['message' => 'Cliente creado con éxito', 'id' => $id]);
        break;

    case 'read':
        $id = $_GET['id'] ?? 0;
        $cliente = $clientesLogic->getClienteById($id);
        echo json_encode($cliente);
        break;

    case 'readAll':
        $clientes = $clientesLogic->getAllClientes();
        echo json_encode($clientes);
        break;

    case 'update':
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $clientesLogic->updateCliente($data['id'], $data['name'], $data['lastname']);
        echo json_encode(['message' => $success ? 'Cliente actualizado con éxito' : 'Error al actualizar cliente']);
        break;

    case 'delete':
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $clientesLogic->deleteCliente($data['id']);
        echo json_encode(['message' => $success ? 'Cliente eliminado con éxito' : 'Error al eliminar cliente']);
        break;

    default:
        echo json_encode(['message' => 'Acción no válida']);
        break;
}
?>
