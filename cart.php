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
SELECT
    cart.id,
    cart.quantity,
    cart.selected,
    products.id AS product_id,
    products.name,
    products.category,
    products.price,
    products.image
FROM cart
JOIN products
ON cart.product_id = products.id
WHERE cart.user_id = ?
ORDER BY cart.id DESC
";

$stmt = $db->prepare($query);
$stmt->execute([
    $_SESSION['user_id']
]);

$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;


foreach ($cartItems as $item) {
    $subtotal = $item['price'] * $item['quantity'];

    $subtotal =
        $item['price'] *
        $item['quantity'];

    if ($item['selected'] == 1) {
        $total += $subtotal;
    }
}

$selectedCount = 0;

foreach ($cartItems as $item) {

    if ($item['selected'] == 1) {

        $selectedCount++;
    }
}
?>

<main>

    <!-- HERO -->
    <section class="relative h-[180px] overflow-hidden">

        <img
            src="assets/images/background/bg-details.svg"
            class="w-full h-full object-cover">

        <div class="absolute inset-0 flex items-center justify-center">

            <h1 class="text-white text-5xl font-bold">
                Shopping Cart
            </h1>

        </div>

    </section>

    <!-- CONTENT -->
    <section class="max-w-6xl mx-auto px-6 py-12">

        <a href="shop.php"
            class="text-sm text-gray-500 hover:text-black">
            ← Back
        </a>

        <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">

            <!-- TABLE HEADER -->
            <div
                class="grid grid-cols-4 bg-[#BFAF98] text-white px-8 py-5 font-medium">

                <div>Product</div>
                <div>Price</div>
                <div>Quantity</div>
                <div>Amount</div>

            </div>

            <?php if (count($cartItems) > 0): ?>

                <?php foreach ($cartItems as $item): ?>

                    <?php
                    $subtotal =
                        $item['price'] *
                        $item['quantity'];
                    ?>

                    <div
                        class="grid grid-cols-4 items-center px-8 py-6 border-b
    <?= $item['selected'] == 0 ? 'opacity-40' : '' ?>">

                        <!-- PRODUCT -->
                        <div class="flex items-center gap-4">

                            <a
                                href="toggle-cart.php?id=<?= $item['id'] ?>"
                                class="shrink-0">

                                <?php if ($item['selected'] == 1): ?>

                                    <div
                                        class="w-6 h-6 rounded-md border-2
                                            border-[#543A14]
                                            bg-[#543A14]
                                            flex items-center justify-center
                                            text-white text-xs
                                            hover:scale-110
                                            transition">
                                        ✓

                                    </div>

                                <?php else: ?>

                                    <div
                                        class="w-6 h-6 rounded-md border-2
                                            border-[#D6CFC7]
                                            hover:border-[#543A14]
                                            transition">
                                    </div>

                                <?php endif; ?>

                            </a>

                            <img
                                src="<?= htmlspecialchars($item['image']) ?>"
                                alt="<?= htmlspecialchars($item['name']) ?>"
                                class="w-24 h-24 object-contain rounded-lg bg-[#FAFAFA] p-2">

                            <div>

                                <h3 class="font-semibold text-[#1E1E1E]">
                                    <?= htmlspecialchars($item['name']) ?>
                                </h3>

                                <p class="text-sm text-gray-500">
                                    <?= htmlspecialchars($item['category']) ?>
                                </p>

                            </div>

                        </div>

                        <!-- PRICE -->
                        <div class="font-medium">
                            $<?= number_format($item['price'], 2) ?>
                        </div>

                        <!-- QUANTITY -->
                        <div>

                            <div
                                class="inline-flex items-center border border-[#D6CFC7] rounded-full overflow-hidden">

                                <a
                                    href="update-cart.php?id=<?= $item['id'] ?>&action=decrease"
                                    class="px-4 py-2 hover:bg-gray-100">

                                    -

                                </a>

                                <span class="px-4">

                                    <?= $item['quantity'] ?>

                                </span>

                                <a
                                    href="update-cart.php?id=<?= $item['id'] ?>&action=increase"
                                    class="px-4 py-2 hover:bg-gray-100">

                                    +

                                </a>

                            </div>

                        </div>

                        <!-- AMOUNT -->
                        <div class="flex items-center justify-between">

                            <span class="font-semibold">

                                $<?= number_format($subtotal, 2) ?>

                            </span>

                            <button
                                onclick="openDeleteModal(<?= $item['id'] ?>)"
                                class="text-[#543A14]
                                    hover:text-black
                                    hover:scale-125
                                    transition duration-300">

                                ✕

                            </button>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="py-20 text-center">

                    <h2 class="text-xl font-medium text-gray-500">
                        Your cart is empty
                    </h2>

                    <a
                        href="shop.php"
                        class="inline-block mt-5 bg-black text-white px-6 py-3 rounded-full">

                        Continue Shopping

                    </a>

                </div>

            <?php endif; ?>

        </div>

        <!-- TOTAL -->

        <div class="flex justify-end mt-8">

            <div class="text-right">

                <h3 class="text-2xl font-semibold mb-8">

                    Total In Your Cart

                    <span class="ml-6 text-[#543A14]">

                        $<?= number_format($total, 2) ?>

                    </span>

                </h3>

                <?php if ($selectedCount > 0): ?>

                    <a
                        href="checkout.php"
                        class="inline-block
                            bg-black text-white
                            px-12 py-3
                            rounded-full
                            text-base font-medium
                            hover:bg-[#FFF0DC]
                            hover:text-[#543A14]
                            transition-all duration-300">

                        Checkout

                    </a>

                <?php else: ?>

                    <button
                        disabled
                        class="inline-block
                            bg-gray-300
                            text-gray-500
                            px-12 py-3
                            rounded-full
                            text-base font-medium
                            cursor-not-allowed">

                        Checkout

                    </button>

                <?php endif; ?>

            </div>

        </div>

    </section>

</main>

<!-- DELETE MODAL -->
<div
    id="deleteModal"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

    <div
        class="bg-white w-[420px] rounded-3xl p-8 shadow-2xl text-center animate-[fadeIn_.25s_ease-out]">

        <h2 class="text-2xl font-semibold text-[#1E1E1E] mb-3">
            Remove Product
        </h2>

        <p class="text-gray-500 mb-8">
            Are you sure you want to remove this product from your cart?
        </p>

        <div class="flex justify-center gap-3">

            <button
                onclick="closeDeleteModal()"
                class="px-6 py-3 border border-[#D6CFC7]
                        rounded-full
                        hover:bg-gray-100
                        transition">

                Cancel

            </button>

            <a
                id="deleteLink"
                href="#"
                class="bg-black text-white
                        px-8 py-3
                        rounded-full
                        hover:bg-[#543A14]
                        transition">

                Remove

            </a>

        </div>

    </div>

</div>

<?php include 'components/footer.php'; ?>

<script>
    function openDeleteModal(id) {
        document
            .getElementById('deleteModal')
            .classList
            .remove('hidden');

        document
            .getElementById('deleteModal')
            .classList
            .add('flex');

        document
            .getElementById('deleteLink')
            .href =
            'remove-cart.php?id=' + id;
    }

    function closeDeleteModal() {
        document
            .getElementById('deleteModal')
            .classList
            .add('hidden');

        document
            .getElementById('deleteModal')
            .classList
            .remove('flex');
    }
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>