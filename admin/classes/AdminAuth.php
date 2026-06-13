<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database.php';

class AdminAuth
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
    | LOGIN ADMIN
    |--------------------------------------------------------------------------
    */

    public function login($email, $password)
    {
        try {

            $query = "
                SELECT *
                FROM admins
                WHERE email = ?
                LIMIT 1
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);

            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$admin) {

                return [
                    'success' => false,
                    'message' => 'Email tidak ditemukan'
                ];
            }

            if (!password_verify(
                $password,
                $admin['password']
            )) {

                return [
                    'success' => false,
                    'message' => 'Password salah'
                ];
            }

            // SESSION ADMIN
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['username'];
            $_SESSION['admin_email'] = $admin['email'];

            return [
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => 'dashboard.php'
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
    | LOGOUT ADMIN
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
    | CEK LOGIN ADMIN
    |--------------------------------------------------------------------------
    */

    public function isLoggedIn()
    {
        return isset($_SESSION['admin_logged_in']) &&
            $_SESSION['admin_logged_in'] === true;
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
    | GET ADMIN
    |--------------------------------------------------------------------------
    */

    public function getAdmin()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return [
            'id'       => $_SESSION['admin_id'],
            'username' => $_SESSION['admin_name'],
            'email'    => $_SESSION['admin_email']
        ];
    }
}
