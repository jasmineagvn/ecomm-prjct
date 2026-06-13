<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$id = $_GET['id'] ?? 0;

$stmt = $db->prepare("
    SELECT *
    FROM products
    WHERE id = ?
");

$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {

    header(
        "Location: products.php"
    );

    exit;
}

/*
|--------------------------------------------------------------------------
| HAPUS FILE GAMBAR
|--------------------------------------------------------------------------
*/

$imageFile =
    '../' .
    $product['image'];

if (
    file_exists($imageFile)
) {

    unlink($imageFile);
}

/*
|--------------------------------------------------------------------------
| HAPUS DATA
|--------------------------------------------------------------------------
*/

$stmt = $db->prepare("
    DELETE FROM products
    WHERE id = ?
");

$stmt->execute([$id]);

header(
    "Location: category-products.php?category=" .
        urlencode(
            $product['category']
        )
);

exit;
