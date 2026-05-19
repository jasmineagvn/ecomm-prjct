<?php
class Database {
    private $host = "localhost:3307";
    private $user = "root";
    private $pass = "";
    private $db   = "db_ecomm";
    private $conn;

    public function getConnection() {
        if ($this->conn !== null) {
            return $this->conn;
        }
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                $this->user,
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
            return null;
        }
    }
}
?>
