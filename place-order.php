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
$paymentMethod = $_POST['payment_method'];

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
    ?, ?, ?, ?, ?, ?, ?, ?
)
");

$status = ($paymentMethod == 'COD')
    ? 'processing'
    : 'pending';

$stmt->execute([
    $userId,
    $fullname,
    $email,
    $phone,
    $address,
    $total,
    $paymentMethod,
    $status
]);

$orderId = $db->lastInsertId();

/* KHUSUS COD */
if ($paymentMethod == 'cod') {

    $stmt = $db->prepare("
    UPDATE orders
    SET status = 'processing'
    WHERE id = ?
    ");

    $stmt->execute([$orderId]);

}

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

if ($paymentMethod == 'COD') {
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <!-- ORDER SUCCESS MODAL -->
<div
  id="successModal"
  class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">

  <div
    class="bg-white w-[420px] rounded-3xl p-8 shadow-2xl text-center">

    <!-- ICON -->
    <img
      src="assets/icons/check.png"
      alt="Success"
      class="w-20 h-20 mx-auto mb-4">

    <h2 class="text-2xl font-semibold text-[#1E1E1E] mb-3">

      Order Success

    </h2>

    <p class="text-gray-500 mb-8">

      Your order has been placed successfully. <br>
      Pay directly when your order arrives.

    </p>

    <div class="flex justify-center gap-3">

      <a
        href="orders.php"
        class="bg-black text-white
               px-8 py-3
               rounded-full
               hover:bg-[#FFF0DC]
               hover:text-[#543A14]
               transition-all duration-300">

        View Orders

      </a>

    </div>

  </div>

</div>

</body>
</html>
<?php
exit();
}

/* MIDTRANS SNAP PARAMS */
$params = [
    'transaction_details' => [
        'order_id' => 'ORDER-' . $orderId . '-' . time(),
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