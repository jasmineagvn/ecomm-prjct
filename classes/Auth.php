<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

class Auth
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        if (!$this->db) {
            die("Koneksi database gagal.");
        }
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login($email, $password)
    {
        try {

            $query = "SELECT * FROM users WHERE email = ? LIMIT 1";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {

                return [
                    'success' => false,
                    'message' => 'Email tidak ditemukan'
                ];
            }

            if (!password_verify($password, $user['password'])) {

                return [
                    'success' => false,
                    'message' => 'Password salah'
                ];
            }

            // SESSION LOGIN
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            return [
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => 'index.php'
            ];
        } catch (PDOException $e) {

            return [
                'success' => false,
                'message' => 'Database Error: ' . $e->getMessage()
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit();
    }

    /*
    |--------------------------------------------------------------------------
    | CEK LOGIN
    |--------------------------------------------------------------------------
    */

    public function isLoggedIn()
    {
        return isset($_SESSION['user_logged_in']) &&
            $_SESSION['user_logged_in'] === true;
    }

    /*
    |--------------------------------------------------------------------------
    | WAJIB LOGIN
    |--------------------------------------------------------------------------
    */

    public function requireLogin()
    {
        if (!$this->isLoggedIn()) {

            header("Location: login.php");
            exit();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | GET USER LOGIN
    |--------------------------------------------------------------------------
    */

    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return [
            'id'       => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email'    => $_SESSION['email']
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function updateProfile($id, $username, $email)
    {
        try {

            $query = "
                UPDATE users
                SET username = ?, email = ?
                WHERE id = ?
            ";

            $stmt = $this->db->prepare($query);

            $stmt->execute([
                $username,
                $email,
                $id
            ]);

            // UPDATE SESSION
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            return [
                'success' => true,
                'message' => 'Profile berhasil diperbarui'
            ];
        } catch (PDOException $e) {

            return [
                'success' => false,
                'message' => 'Database Error: ' . $e->getMessage()
            ];
        }
    }
}
