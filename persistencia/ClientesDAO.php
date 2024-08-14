<?php
require_once 'ClientesDAO.php'; // Incluye la clase DAO
require_once 'ClientesDTO.php'; // Incluye la clase DTO

class ClientesLogic {
    private $clientesDAO;

    public function __construct() {
        $this->clientesDAO = new ClientesDAO();
    }

    // Crear un cliente
    public function createCliente($name, $lastname) {
        $id = $this->clientesDAO->createClient($name, $lastname);
        return $id;
    }

    // Leer un cliente por ID
    public function getClienteById($id) {
        $clienteData = $this->clientesDAO->readClient($id);
        if ($clienteData) {
            return $this->mapToDTO($clienteData);
        } else {
            return null;
        }
    }

    // Leer todos los clientes
    public function getAllClientes() {
        $clientesData = $this->clientesDAO->readAllClients();
        $clientesDTOs = [];
        foreach ($clientesData as $clienteData) {
            $clientesDTOs[] = $this->mapToDTO($clienteData);
        }
        return $clientesDTOs;
    }

    // Actualizar un cliente
    public function updateCliente($id, $name, $lastname) {
        return $this->clientesDAO->updateClient($id, $name, $lastname);
    }

    // Eliminar un cliente
    public function deleteCliente($id) {

