<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id = (int) $_GET['id'];

try {

    // hapus order milik user dulu
    $stmt = $db->prepare("
        DELETE FROM orders
        WHERE user_id = ?
    ");

    $stmt->execute([$id]);

    // hapus user
    $stmt = $db->prepare("
        DELETE FROM users
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    header("Location: users.php?deleted=1");
    exit();

} catch(PDOException $e) {

    die("Error: " . $e->getMessage());

}