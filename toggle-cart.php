<?php

session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    exit();
}

$id = $_GET['id'] ?? 0;

$database = new Database();
$db = $database->getConnection();

/*
|--------------------------------------------------------------------------
| CEK STATUS SEKARANG
|--------------------------------------------------------------------------
*/

$query = "
SELECT selected
FROM cart
WHERE id = ?
AND user_id = ?
";

$stmt = $db->prepare($query);

$stmt->execute([
    $id,
    $_SESSION['user_id']
]);

$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {

    header("Location: cart.php");
    exit();
}

$newValue =
    $item['selected'] == 1
    ? 0
    : 1;

/*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

$query = "
UPDATE cart
SET selected = ?
WHERE id = ?
";

$stmt = $db->prepare($query);

$stmt->execute([
    $newValue,
    $id
]);

header("Location: cart.php");
exit();
