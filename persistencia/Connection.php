<?php
// Singleton Database Connection

class Connection {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = 'localhost';
        $dbname = 'lavendida';
        $user = 'root';
        $password = '';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";


        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>
