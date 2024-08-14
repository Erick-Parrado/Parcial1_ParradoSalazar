<?php
require './Connection.php';

try{
    $db = Connection::getInstance();
    $pdo = $db->getPDO();
    echo"Bien";
}catch (PDOException $e){
    echo "Mal". $e->getMessage();
}
?>