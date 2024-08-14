<?php
require './Connection.php';

try {
    $dbname = Connection::getInstance();
    $pdo = $dbname->getPDO();
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Falló la conexión: " . $e->getMessage();
}
?>