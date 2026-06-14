<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$user_id = $_SESSION['user_id'];

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment_method = $_POST['payment_method'];

/*
|--------------------------------------------------------------------------
| AMBIL ITEM CART YANG DICHECKOUT
|--------------------------------------------------------------------------
*/

$query = "
SELECT
    cart.product_id,
    cart.quantity,
    products.price
FROM cart
JOIN products
ON cart.product_id = products.id
WHERE cart.user_id = ?
AND cart.selected = 1
";

$stmt = $db->prepare($query);
$stmt->execute([$user_id]);

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($items) == 0) {
    header("Location: cart.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| HITUNG TOTAL
|--------------------------------------------------------------------------
*/

$subtotal = 0;

foreach ($items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$tax = $subtotal * 0.10;
$total = $subtotal + $tax;

/*
|--------------------------------------------------------------------------
| SIMPAN KE ORDERS
|--------------------------------------------------------------------------
*/

$orderQuery = "
INSERT INTO orders
(
    user_id,
    fullname,
    email,
    phone,
    address,
    total,
    payment_method,
    status
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?, 'pending'
)
";

$stmtOrder = $db->prepare($orderQuery);

$stmtOrder->execute([
    $user_id,
    $fullname,
    $email,
    $phone,
    $address,
    $total,
    $payment_method
]);

$order_id = $db->lastInsertId();

/*
|--------------------------------------------------------------------------
| SIMPAN DETAIL ORDER
|--------------------------------------------------------------------------
*/

foreach ($items as $item) {

    $detailQuery = "
    INSERT INTO order_items
    (
        order_id,
        product_id,
        quantity,
        price
    )
    VALUES
    (
        ?, ?, ?, ?
    )
    ";

    $stmtDetail = $db->prepare($detailQuery);

    $stmtDetail->execute([
        $order_id,
        $item['product_id'],
        $item['quantity'],
        $item['price']
    ]);
}

/*
|--------------------------------------------------------------------------
| HAPUS CART
|--------------------------------------------------------------------------
*/

$delete = "
DELETE FROM cart
WHERE user_id = ?
AND selected = 1
";

$stmtDelete = $db->prepare($delete);
$stmtDelete->execute([$user_id]);

header("Location: orders.php");
exit();