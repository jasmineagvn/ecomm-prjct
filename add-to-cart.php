<?php

session_start();

require_once 'config/database.php';

/*
|--------------------------------------------------------------------------
| HARUS LOGIN
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$user_id = $_SESSION['user_id'];
$product_id = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;

/*
|--------------------------------------------------------------------------
| VALIDASI ID PRODUK
|--------------------------------------------------------------------------
*/

if ($product_id <= 0) {

    header("Location: shop.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| CEK PRODUK
|--------------------------------------------------------------------------
*/

$query = "
    SELECT id
    FROM products
    WHERE id = ?
";

$stmt = $db->prepare($query);
$stmt->execute([$product_id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {

    header("Location: shop.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| CEK CART
|--------------------------------------------------------------------------
*/

$query = "
    SELECT *
    FROM cart
    WHERE user_id = ?
    AND product_id = ?
";

$stmt = $db->prepare($query);

$stmt->execute([
    $user_id,
    $product_id
]);

$cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| JIKA SUDAH ADA
|--------------------------------------------------------------------------
*/

if ($cartItem) {

    $query = "
        UPDATE cart
        SET quantity = quantity + 1
        WHERE id = ?
    ";

    $stmt = $db->prepare($query);

    $stmt->execute([
        $cartItem['id']
    ]);
} else {

    /*
    |--------------------------------------------------------------------------
    | JIKA BELUM ADA
    |--------------------------------------------------------------------------
    */

    $query = "
        INSERT INTO cart
        (
            user_id,
            product_id,
            quantity
        )
        VALUES
        (
            ?,
            ?,
            1
        )
    ";

    $stmt = $db->prepare($query);

    $stmt->execute([
        $user_id,
        $product_id
    ]);
}

/*
|--------------------------------------------------------------------------
| REDIRECT CART
|--------------------------------------------------------------------------
*/

header("Location: cart.php");
exit();
