<?php

session_start();

require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}

$cart_id = $_GET['id'] ?? 0;
$action = $_GET['action'] ?? '';

$database = new Database();
$db = $database->getConnection();

/*
|--------------------------------------------------------------------------
| CEK CART
|--------------------------------------------------------------------------
*/

$query = "
SELECT *
FROM cart
WHERE id = ?
";

$stmt = $db->prepare($query);
$stmt->execute([
    $cart_id
]);

$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {

    header("Location: cart.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| TAMBAH QTY
|--------------------------------------------------------------------------
*/

if ($action === 'increase') {

    $query = "
    UPDATE cart
    SET quantity = quantity + 1
    WHERE id = ?
    ";

    $stmt = $db->prepare($query);

    $stmt->execute([
        $cart_id
    ]);
}

/*
|--------------------------------------------------------------------------
| KURANG QTY
|--------------------------------------------------------------------------
*/

if ($action === 'decrease') {

    if ($item['quantity'] > 1) {

        $query = "
        UPDATE cart
        SET quantity = quantity - 1
        WHERE id = ?
        ";

        $stmt = $db->prepare($query);

        $stmt->execute([
            $cart_id
        ]);
    } else {

        $query = "
        DELETE FROM cart
        WHERE id = ?
        ";

        $stmt = $db->prepare($query);

        $stmt->execute([
            $cart_id
        ]);
    }
}

header("Location: cart.php");
exit();
