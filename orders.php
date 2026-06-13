<?php

include 'components/header.php';
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$query = "
    SELECT *
    FROM orders
    WHERE user_id = ?
    ORDER BY created_at DESC
";

$stmt = $db->prepare($query);

$stmt->execute([
    $_SESSION['user_id']
]);

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main>

    <!-- HERO -->
    <section class="relative h-[180px] overflow-hidden">

        <img
            src="assets/images/background/bg-details.svg"
            class="w-full h-full object-cover">

        <div class="absolute inset-0 flex items-center justify-center">

            <h1 class="text-white text-5xl font-bold">
                My Orders
            </h1>

        </div>

    </section>

    <!-- CONTENT -->
    <section class="max-w-6xl mx-auto px-6 py-12">

        <?php if (count($orders) > 0): ?>

            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                <!-- HEADER -->
                <div
                    class="grid grid-cols-5 bg-[#BFAF98] text-white px-8 py-5 font-medium">

                    <div>Order ID</div>
                    <div>Date</div>
                    <div>Payment</div>
                    <div>Status</div>
                    <div>Total</div>

                </div>

                <?php foreach ($orders as $order): ?>

                    <?php

                    $status = $order['status'];

                    $color = match ($status) {

                        'pending' => 'bg-yellow-100 text-yellow-700',

                        'processing' => 'bg-blue-100 text-blue-700',

                        'completed' => 'bg-green-100 text-green-700',

                        'cancelled' => 'bg-red-100 text-red-700',

                        default => 'bg-gray-100 text-gray-700'
                    };

                    ?>

                    <div
                        class="grid grid-cols-5 px-8 py-6 border-b items-center hover:bg-[#FAFAFA] transition">

                        <div class="font-medium">
                            #ORD<?= $order['id'] ?>
                        </div>

                        <div>
                            <?= date(
                                'd M Y',
                                strtotime($order['created_at'])
                            ) ?>
                        </div>

                        <div>
                            <?= htmlspecialchars($order['payment_method']) ?>
                        </div>

                        <div>

                            <span
                                class="<?= $color ?> px-3 py-1 rounded-full text-xs">

                                <?= ucfirst($order['status']) ?>

                            </span>

                        </div>

                        <div class="font-semibold text-[#543A14]">

                            $<?= number_format($order['total'], 2) ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div
                class="bg-white rounded-3xl shadow-lg p-16 text-center">

                <div
                    class="w-24 h-24 mx-auto mb-6 rounded-full bg-[#F7E9D7] flex items-center justify-center">

                    <img
                        src="assets/icons/orders.svg"
                        alt="Orders"
                        class="w-12 h-12">

                </div>

                <h2
                    class="text-3xl font-bold text-[#1E1E1E]">

                    No Orders Yet

                </h2>

                <p
                    class="text-gray-500 mt-4">

                    Looks like you haven't placed any orders yet.

                </p>

                <a
                    href="shop.php"
                    class="inline-block mt-8
                            bg-black text-white
                            px-10 py-3 rounded-full
                            hover:bg-[#FFF0DC]
                            hover:text-[#543A14]
                            transition-all duration-300">

                    Start Shopping

                </a>

            </div>

        <?php endif; ?>

    </section>

</main>

<?php include 'components/footer.php'; ?>