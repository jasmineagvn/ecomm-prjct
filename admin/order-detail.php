<?php
session_start();

require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$order_id = $_GET['id'];

/*
|--------------------------------------------------------------------------
| UPDATE STATUS
|--------------------------------------------------------------------------
*/

if (isset($_POST['update_status'])) {

    $status = $_POST['status'];

    $update = "
    UPDATE orders
    SET status = ?
    WHERE id = ?
    ";

    $stmt = $db->prepare($update);
    $stmt->execute([
        $status,
        $order_id
    ]);

    header("Location: order-detail.php?id=" . $order_id);
    exit();
}

/*
|--------------------------------------------------------------------------
| AMBIL DATA ORDER
|--------------------------------------------------------------------------
*/

$query = "
SELECT *
FROM orders
WHERE id = ?
LIMIT 1
";

$stmt = $db->prepare($query);
$stmt->execute([$order_id]);

$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order tidak ditemukan");
}

/*
|--------------------------------------------------------------------------
| AMBIL DETAIL PRODUK ORDER
|--------------------------------------------------------------------------
*/

$itemStmt = $db->prepare("
    SELECT
        oi.*,
        p.name,
        p.image,
        p.category
    FROM order_items oi
    JOIN products p
        ON oi.product_id = p.id
    WHERE oi.order_id = ?
");

$itemStmt->execute([$order_id]);

$orderItems = $itemStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Order Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F5F0]">

<div class="max-w-6xl mx-auto py-10 px-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold text-[#543A14]">
                Order #<?= $order['id']; ?>
            </h1>

            <p class="text-gray-500 mt-1">
                <?= date('d M Y H:i', strtotime($order['created_at'])); ?>
            </p>
        </div>

        <span class="px-4 py-2 rounded-full text-sm font-semibold
        <?=
        $order['status'] == 'pending' ? 'bg-yellow-100 text-yellow-700' :
        ($order['status'] == 'processing' ? 'bg-blue-100 text-blue-700' :
        ($order['status'] == 'completed' ? 'bg-green-100 text-green-700' :
        'bg-red-100 text-red-700'));
        ?>">
            <?= ucfirst($order['status']); ?>
        </span>

    </div>

    <!-- CUSTOMER -->
    <div class="bg-white rounded-3xl shadow-sm p-8 mb-6">

        <h2 class="text-xl font-bold text-[#543A14] mb-5">
            Customer Information
        </h2>

        <div class="grid md:grid-cols-2 gap-4">

            <div>
                <p class="text-gray-500">Full Name</p>
                <p class="font-medium"><?= htmlspecialchars($order['fullname']); ?></p>
            </div>

            <div>
                <p class="text-gray-500">Email</p>
                <p class="font-medium"><?= htmlspecialchars($order['email']); ?></p>
            </div>

            <div>
                <p class="text-gray-500">Phone</p>
                <p class="font-medium"><?= htmlspecialchars($order['phone']); ?></p>
            </div>

            <div>
                <p class="text-gray-500">Address</p>
                <p class="font-medium"><?= htmlspecialchars($order['address']); ?></p>
            </div>

        </div>

    </div>

    <!-- PAYMENT -->
    <div class="bg-white rounded-3xl shadow-sm p-8 mb-6">

        <h2 class="text-xl font-bold text-[#543A14] mb-5">
            Payment Information
        </h2>

        <div class="grid md:grid-cols-2 gap-4">

            <div>
                <p class="text-gray-500">Method</p>
                <p class="font-medium">
                    <?= htmlspecialchars($order['payment_method']); ?>
                </p>
            </div>

            <div>
                <p class="text-gray-500">Total</p>
                <p class="font-bold text-xl text-[#543A14]">
                    $<?= number_format($order['total'],2); ?>
                </p>
            </div>

        </div>

    </div>

    <!-- UPDATE STATUS -->
    <div class="bg-white rounded-3xl shadow-sm p-8 mb-6">

        <h2 class="text-xl font-bold text-[#543A14] mb-5">
            Update Status
        </h2>

        <form method="POST" class="flex gap-4">

            <select
                name="status"
                class="border rounded-xl px-4 py-3 flex-1">

                <option value="pending" <?= $order['status']=='pending'?'selected':'' ?>>
                    Pending
                </option>

                <option value="paid" <?= $order['status']=='paid'?'selected':'' ?>>
                    Paid
                </option>

                <option value="processing" <?= $order['status']=='processing'?'selected':'' ?>>
                    Processing
                </option>

                <option value="shipped" <?= $order['status']=='shipped'?'selected':'' ?>>
                    Shipped
                </option>

                <option value="completed" <?= $order['status']=='completed'?'selected':'' ?>>
                    Completed
                </option>

                <option value="cancelled" <?= $order['status']=='cancelled'?'selected':'' ?>>
                    Cancelled
                </option>

            </select>

            <button
                type="submit"
                name="update_status"
                class="bg-[#543A14] hover:bg-[#3f2a0f] text-white px-8 rounded-xl">

                Update

            </button>

        </form>

    </div>

    <!-- PRODUCTS -->
    <div class="bg-white rounded-3xl shadow-sm p-8">

        <h2 class="text-xl font-bold text-[#543A14] mb-6">
            Ordered Products
        </h2>

        <?php foreach($orderItems as $item): ?>

            <div class="flex items-center gap-5 border-b py-4">

                <img
                    src="../<?= $item['image']; ?>"
                    class="w-24 h-24 object-cover rounded-xl">

                <div class="flex-1">

                    <h4 class="font-semibold text-lg">
                        <?= htmlspecialchars($item['name']); ?>
                    </h4>

                    <p class="text-gray-500">
                        <?= htmlspecialchars($item['category']); ?>
                    </p>

                </div>

                <div class="text-center">
                    <p class="text-gray-500">Qty</p>
                    <p class="font-semibold">
                        <?= $item['quantity']; ?>
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-gray-500">Price</p>
                    <p class="font-semibold">
                        $<?= number_format($item['price'],2); ?>
                    </p>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <div class="mt-6">
        <a
            href="orders.php"
            class="text-[#543A14] font-medium hover:underline">
            ← Back to Orders
        </a>
    </div>

</div>

</body>

</html>