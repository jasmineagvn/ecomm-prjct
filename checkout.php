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
    products.id AS product_id,
    products.name,
    products.price,
    products.image,
    products.category
FROM cart
JOIN products
ON cart.product_id = products.id
WHERE cart.user_id = ?
AND cart.selected = 1
";

$stmt = $db->prepare($query);
$stmt->execute([
    $_SESSION['user_id']
]);

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($items) == 0) {
    header("Location: cart.php");
    exit();
}

$subtotal = 0;

foreach ($items as $item) {

    $subtotal +=
        $item['price'] *
        $item['quantity'];
}

$tax = $subtotal * 0.10;
$total = $subtotal + $tax;

?>

<main>

    <!-- HERO -->
    <section class="relative h-[180px] overflow-hidden">

        <img
            src="assets/images/background/bg-details.svg"
            class="w-full h-full object-cover">

        <div class="absolute inset-0 flex items-center justify-center">

            <h1 class="text-white text-5xl font-bold">
                Checkout
            </h1>

        </div>

    </section>

    <section class="max-w-6xl mx-auto px-6 py-12">

        <a href="cart.php"
            class="text-sm text-gray-500 hover:text-black">
            ← Back
        </a>

        <form
            action="place-order.php"
            method="POST"
            class="grid md:grid-cols-3 gap-8 mt-6">

            <!-- LEFT -->
            <div class="md:col-span-2 space-y-6">

                <!-- SHIPPING -->
                <div class="bg-white rounded-2xl shadow-md p-8">

                    <h2 class="text-xl font-semibold mb-6">
                        Shipping Address
                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="text-sm">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="fullname"
                                required
                                class="w-full mt-2 border border-[#D6CFC7] rounded-full px-5 py-3">

                        </div>

                        <div>

                            <label class="text-sm">
                                Address
                            </label>

                            <textarea
                                name="address"
                                required
                                rows="4"
                                class="w-full mt-2 border border-[#D6CFC7] rounded-2xl px-5 py-3"></textarea>

                        </div>

                        <div>

                            <label class="text-sm">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                required
                                class="w-full mt-2 border border-[#D6CFC7] rounded-full px-5 py-3">

                        </div>

                        <div>

                            <label class="text-sm">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                name="phone"
                                required
                                class="w-full mt-2 border border-[#D6CFC7] rounded-full px-5 py-3">

                        </div>

                    </div>

                </div>

                <!-- PAYMENT -->
                <div class="bg-white rounded-2xl shadow-md p-8">

                    <h2 class="text-xl font-semibold mb-6">
                        Payment Method
                    </h2>

                    <div class="grid md:grid-cols-3 gap-4">

                        <label
                            class="border border-[#D6CFC7]
                                   rounded-xl p-4 text-center
                                   cursor-pointer hover:border-[#543A14]">

                            <input
                                type="radio"
                                name="payment_method"
                                value="QRIS"
                                checked
                                class="hidden payment-radio">

                            <p class="font-medium">
                                QRIS
                            </p>

                        </label>

                        <label
                            class="border border-[#D6CFC7]
                                   rounded-xl p-4 text-center
                                   cursor-pointer hover:border-[#543A14]">

                            <input
                                type="radio"
                                name="payment_method"
                                value="VA"
                                class="hidden payment-radio">

                            <p class="font-medium">
                                Virtual Account
                            </p>

                        </label>

                        <label
                            class="border border-[#D6CFC7]
                                   rounded-xl p-4 text-center
                                   cursor-pointer hover:border-[#543A14]">

                            <input
                                type="radio"
                                name="payment_method"
                                value="COD"
                                class="hidden payment-radio">

                            <p class="font-medium">
                                COD
                            </p>

                        </label>

                    </div>

                    <!-- QRIS -->
                    <div
                        id="qrisBox"
                        class="mt-6 text-center">

                        <p class="text-sm text-gray-500 mt-3">
                            Scan QRIS after placing your order.
                        </p>

                    </div>

                    <!-- VA -->
                    <div
                        id="vaBox"
                        class="hidden mt-6">

                        <div
                            class="bg-[#FAFAFA]
                                   rounded-xl
                                   p-5">
                        </div>

                    </div>

                    <!-- COD -->
                    <div
                        id="codBox"
                        class="hidden mt-6">

                        <div
                            class="bg-[#FAFAFA]
                                   rounded-xl
                                   p-5">

                            <p>
                                Pay directly when your order arrives.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <div class="bg-white rounded-2xl shadow-md p-8 sticky top-10">

                    <h2 class="text-xl font-semibold mb-6">
                        Order Summary
                    </h2>

                    <?php foreach ($items as $item): ?>

                        <?php
                        $itemTotal =
                            $item['price'] *
                            $item['quantity'];
                        ?>

                        <div
                            class="flex gap-4 mb-5">

                            <img
                                src="<?= $item['image'] ?>"
                                class="w-16 h-16 object-contain bg-[#FAFAFA] rounded-lg p-2">

                            <div class="flex-1">

                                <h4 class="text-sm font-medium">
                                    <?= $item['name'] ?>
                                </h4>

                                <p class="text-xs text-gray-500">
                                    <?= $item['category'] ?>
                                </p>

                                <div
                                    class="flex justify-between mt-2 text-sm">

                                    <span>
                                        $<?= number_format($item['price'], 2) ?>
                                        ×
                                        <?= $item['quantity'] ?>
                                    </span>

                                    <span>
                                        $<?= number_format($itemTotal, 2) ?>
                                    </span>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                    <hr class="my-5">

                    <div class="space-y-3 text-sm">

                        <div class="flex justify-between">

                            <span>Subtotal</span>

                            <span>
                                $<?= number_format($subtotal, 2) ?>
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span>Tax (10%)</span>

                            <span>
                                $<?= number_format($tax, 2) ?>
                            </span>

                        </div>

                        <div
                            class="flex justify-between
                                   text-lg font-bold">

                            <span>Total</span>

                            <span>
                                $<?= number_format($total, 2) ?>
                            </span>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="w-full mt-8
                               bg-black text-white
                               py-3 rounded-full
                               hover:bg-[#FFF0DC]
                               hover:text-[#543A14]
                               transition-all duration-300">

                        Place Order

                    </button>

                </div>

            </div>

        </form>

    </section>

</main>

<script>
    const radios =
        document.querySelectorAll(
            '.payment-radio'
        );

    const qrisBox =
        document.getElementById('qrisBox');

    const vaBox =
        document.getElementById('vaBox');

    const codBox =
        document.getElementById('codBox');

    radios.forEach(radio => {

        radio.addEventListener('change', () => {

            qrisBox.classList.add('hidden');
            vaBox.classList.add('hidden');
            codBox.classList.add('hidden');

            if (radio.value === 'QRIS') {
                qrisBox.classList.remove('hidden');
            }

            if (radio.value === 'VA') {
                vaBox.classList.remove('hidden');
            }

            if (radio.value === 'COD') {
                codBox.classList.remove('hidden');
            }

        });

    });
</script>

<?php include 'components/footer.php'; ?>