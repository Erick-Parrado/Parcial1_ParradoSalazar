<?php
//singleton

class Connection{
    private static $instance = null;
    private $pdo;

    private function __construct(){

        $host = 'localhost';
        $dbname = 'lavendida';
        $user = 'root';
        $password = '';
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        try{
            $this->pdo = new PDO($dsn, $user,$password);
            $this->pdo ->setAttribute(PDO:ATTR_ERRMODE, PDO:ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Falló la conexión". $e->getMessage();
        }

        public static function getInstance(){
            if (self:$instance === null){
                self:$instance = new Connection();
            }
            return self::instance;
        }

        public function getPDO(){
            return $this ->pdo;
        }
    }
}
?>