<?php
session_start();

require_once 'config/database.php';
require_once 'midtrans-php-master/Midtrans.php';

$database = new Database();
$db = $database->getConnection();

/* CONFIG MIDTRANS */
\Midtrans\Config::$serverKey = 'Mid-server-MMUOp9wCG5Act3cU35CRUVzm';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

/* USER INPUT */
$userId = $_SESSION['user_id'];

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

/* AMBIL CART */
$query = "
SELECT
    cart.product_id,
    cart.quantity,
    products.name,
    products.price
FROM cart
JOIN products ON cart.product_id = products.id
WHERE cart.user_id = ?
AND cart.selected = 1
";

$stmt = $db->prepare($query);
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($cartItems) == 0) {
    die('Cart kosong');
}

/* HITUNG TOTAL */
$subtotal = 0;
$itemDetails = [];

foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];

    $itemDetails[] = [
        'id' => $item['product_id'],
        'price' => (int)$item['price'],
        'quantity' => (int)$item['quantity'],
        'name' => $item['name']
    ];
}

$tax = $subtotal * 0.10;
$total = $subtotal + $tax;

/* SIMPAN ORDER */
$stmt = $db->prepare("
INSERT INTO orders
(user_id, fullname, email, phone, address, total, status)
VALUES
(?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $userId,
    $fullname,
    $email,
    $phone,
    $address,
    $total,
    'pending'
]);

$orderId = $db->lastInsertId();

/* SIMPAN ORDER ITEMS */
foreach ($cartItems as $item) {
    $stmt = $db->prepare("
    INSERT INTO order_items
    (order_id, product_id, quantity, price)
    VALUES
    (?, ?, ?, ?)
    ");

    $stmt->execute([
        $orderId,
        $item['product_id'],
        $item['quantity'],
        $item['price']
    ]);
}

$stmt = $db->prepare("
    DELETE FROM cart
    WHERE user_id = ?
    AND selected = 1
");

$stmt->execute([$userId]);

/* MIDTRANS SNAP PARAMS */
$params = [
    'transaction_details' => [
        'order_id' => 'ORDER-' . $orderId,
        'gross_amount' => round($total),
    ],
    'item_details' => $itemDetails,
    'customer_details' => [
        'first_name' => $fullname,
        'email' => $email,
        'phone' => $phone,
    ]
];


/* 🔥 SNAP TOKEN (INI YANG BENAR) */
$snapToken = \Midtrans\Snap::getSnapToken($params);

/* REDIRECT KE PAYMENT */
header("Location: payment.php?token=" . urlencode($snapToken) . "&order_id=" . $orderId);
exit;
?>