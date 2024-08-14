<?php
require_once 'Connection.php'; // Incluye la clase Connection

class ClientesDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Connection::getInstance()->getPDO();
    }

    // Crear un nuevo cliente
    public function createClient($name, $lastname) {
        $sql = "INSERT INTO clientes (name, lastname) VALUES (:name, :lastname)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombreCliente', $name);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    // Leer un cliente específico por ID
    public function readClient($id) {
        $sql = "SELECT * FROM clientes WHERE idCliente = :idCliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Leer todos los clientes
    public function readAllClients() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar un cliente existente
    public function updateClient($id, $name, $lastname) {
        $sql = "UPDATE clientes SET name = :name, lastname = :lastname WHERE idCliente = :idCliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':lastname', $lastname);
        return $stmt->execute();
    }

    // Eliminar un cliente por ID
    public function deleteClient($id) {
        $sql = "DELETE FROM clientes WHERE idCliente = :idCliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
