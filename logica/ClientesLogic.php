<?php
require_once 'ClientesDAO.php'; // Incluye la clase DAO
require_once 'ClientesDTO.php'; // Incluye la clase DTO

class ClientesLogic {
    private $clientesDAO;

    public function __construct() {
        $this->clientesDAO = new ClientesDAO();
    }

    public function createCliente($name, $lastname) {
        return $this->clientesDAO->createClient($name, $lastname);
    }

    public function getClienteById($id) {
        $clienteData = $this->clientesDAO->readClient($id);
        if ($clienteData) {
            return $this->mapToDTO($clienteData);
        } else {
            return null;
        }
    }

    public function getAllClientes() {
        $clientesData = $this->clientesDAO->readAllClients();
        $clientesDTOs = [];
        foreach ($clientesData as $clienteData) {
            $clientesDTOs[] = $this->mapToDTO($clienteData);
        }
        return $clientesDTOs;
    }

    public function updateCliente($id, $name, $lastname) {
        return $this->clientesDAO->updateClient($id, $name, $lastname);
    }

    public function deleteCliente($id) {
        return $this->clientesDAO->deleteClient($id);
    }

    private function mapToDTO($data) {
        $clienteDTO = new ClientesDTO();
        $clienteDTO->id = $data['idCliente'];
        $clienteDTO->name = $data['nombreCliente'];
        $clienteDTO->lastname = $data['apellidoCliente'];
        return $clienteDTO;
    }
}
?>
