<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

class Auth {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // LOGIN
    public function login($username, $password) {

        try {

            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // CEK PASSWORD
            if ($user && password_verify($password, $user['password'])) {

                // SESSION USER
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                return [
                    'success' => true,
                    'message' => 'Login berhasil',
                    'redirect' => 'index.php'
                ];

            } else {

                return [
                    'success' => false,
                    'message' => 'Username atau password salah'
                ];

            }

        } catch(PDOException $e) {

            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];

        }

    }

    // LOGOUT
    public function logout() {

        session_unset();
        session_destroy();

        header("Location: login.php");
        exit();

    }

    // CEK LOGIN
    public function isLoggedIn() {

        return isset($_SESSION['user_logged_in']) 
            && $_SESSION['user_logged_in'] === true;

    }

    // WAJIB LOGIN
    public function requireLogin() {

        if (!$this->isLoggedIn()) {

            header("Location: login.php");
            exit();

        }

    }

    // UPDATE PROFILE
    public function updateProfile($id, $username, $email) {

        try {

            $query = "UPDATE users 
                      SET username = ?, email = ?
                      WHERE id = ?";

            $stmt = $this->db->prepare($query);

            $stmt->execute([
                $username,
                $email,
                $id
            ]);

            // UPDATE SESSION
            $_SESSION['user_username'] = $username;
            $_SESSION['user_email'] = $email;

            return [
                'success' => true,
                'message' => 'Profile berhasil diperbarui'
            ];

        } catch(PDOException $e) {

            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];

        }

    }

}
?>