<?php

session_start();

require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

$database = new Database();
$db = $database->getConnection();

/*
|--------------------------------------------------------------------------
| HAPUS ITEM CART
|--------------------------------------------------------------------------
*/

$query = "
DELETE FROM cart
WHERE id = ?
";

$stmt = $db->prepare($query);
$stmt->execute([
    $id
]);

header("Location: cart.php");
exit();
