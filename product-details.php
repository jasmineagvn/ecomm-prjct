<?php include 'components/header.php'; ?>

<?php

require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// AMBIL ID PRODUK
$id = $_GET['id'] ?? 0;

// PRODUK AKTIF
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$id]);

$selectedProduct = $stmt->fetch(PDO::FETCH_ASSOC);

// JIKA PRODUK TIDAK ADA
if (!$selectedProduct) {

  header("Location: shop.php");
  exit();
}

// RELATED PRODUCTS
$queryRelated = "
    SELECT *
    FROM products
    WHERE id != ?
    ORDER BY RAND()
    LIMIT 3
";

$stmtRelated = $db->prepare($queryRelated);
$stmtRelated->execute([$id]);

$relatedProducts = $stmtRelated->fetchAll(PDO::FETCH_ASSOC);

?>

<main>

  <!-- HERO -->
  <section class="relative h-[180px] overflow-hidden">

    <img
      src="assets/images/background/bg-details.svg"
      class="w-full h-full object-cover">

    <div class="absolute inset-0 flex items-center justify-center">

      <h1 class="text-white text-5xl font-bold">
        Products Details
      </h1>

    </div>

  </section>


  <section class="max-w-6xl mx-auto px-6 py-12">

    <a href="shop.php"
      class="text-gray-500 text-sm">
      ← Back
    </a>

    <div class="grid md:grid-cols-2 gap-12 mt-6">

      <!-- IMAGE -->
      <div class="bg-[#FAFAFA] rounded-3xl p-8 flex items-center justify-center">

        <img
          src="<?= htmlspecialchars($selectedProduct['image']) ?>"
          alt="<?= htmlspecialchars($selectedProduct['name']) ?>"
          class="max-h-[350px] object-contain">

      </div>

      <!-- INFO -->
      <div>

        <p class="text-sm text-[#8B7355] mb-2">
          <?= htmlspecialchars($selectedProduct['category']) ?>
        </p>

        <h1 class="text-4xl font-bold mb-4">
          <?= htmlspecialchars($selectedProduct['name']) ?>
        </h1>

        <p class="text-[#6B6B6B] text-sm leading-relaxed mb-6">
          <?= htmlspecialchars($selectedProduct['description']) ?>
        </p>

        <h2 class="text-2xl font-bold mb-3">
          Rp<?= number_format($selectedProduct['price'], 2) ?>
        </h2>

        <!-- RATING -->
        <div class="flex items-center gap-2 mb-6">

          <span class="text-yellow-500">
            ★★★★★
          </span>

          <span class="text-xs text-gray-500">
            4.8 (120 reviews)
          </span>

        </div>

        <!-- QUANTITY -->
        <div class="flex items-center gap-3 mb-6">

          <span class="text-sm">
            Quantity
          </span>

          <input
            type="number"
            min="1"
            value="1"
            class="w-20 border rounded-lg px-3 py-2 text-center">

        </div>

        <!-- BUTTON -->
        <div class="flex gap-3 mb-8">

          <a
            href="add-to-cart.php?id=<?= $selectedProduct['id']; ?>"
            class="px-8 py-3
                  border border-[#D6CFC7]
                  rounded-full
                  bg-white text-[#543A14]
                  hover:bg-[#543A14]
                  hover:text-white
                  hover:border-[#543A14]
                  transition-all duration-300">

            Add To Cart

          </a>

          <a
            href="checkout.php?id=<?= $selectedProduct['id']; ?>"
            class="px-8 py-3
                  bg-black text-white
                  rounded-full
                  hover:bg-[#FFF0DC]
                  hover:text-[#543A14]
                  transition-all duration-300">

            Buy Now

          </a>

        </div>

        <!-- INFO -->
        <div class="space-y-3 text-sm text-gray-500">

          <p>
            🚚 Free standard delivery on all orders
          </p>

          <p>
            📦 Estimated delivery: 2–4 business days
          </p>

          <p>
            📍 Available for shipping nationwide
          </p>

        </div>

      </div>

    </div>

  </section>

  <!-- RELATED -->
  <section class="max-w-5xl mx-auto px-6 pb-20">

    <h2 class="text-[40px] font-bold text-center mb-2">
      You May Also Like
    </h2>

    <p class="text-center text-[16px] text-[#543A14] mb-8">
      Discover more pieces that perfectly complement your style.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <?php foreach ($relatedProducts as $p): ?>

        <div
          class="bg-white rounded-[24px]
                border border-[#F0F0F0]
                p-5
                shadow-sm
                hover:shadow-lg
                transition-all duration-300">

          <a href="product-details.php?id=<?= $p['id']; ?>">

            <div
              class="bg-[#FAFAFA]
                    rounded-[20px]
                    h-[280px]
                    flex items-center justify-center
                    overflow-hidden">

              <img
                src="<?= $p['image']; ?>"
                alt="<?= $p['name']; ?>"
                class="max-h-[220px] max-w-[220px] object-contain">

            </div>

            <div class="mt-3 flex justify-between">
              <div>
                <h3 class="text-sm font-medium"><?= $p['name']; ?></h3>
                <p class="text-xs text-gray-400"><?= $p['category']; ?></p>
              </div>

              <p class="text-sm font-medium">Rp<?= number_format($p['price'], 2); ?></p>
            </div>

            <div class="flex gap-2 mt-4">

              <a
                href="add-to-cart.php?id=<?= $p['id']; ?>"
                class="flex-1 text-center
                      border border-[#D6CFC7]
                      rounded-full py-2 text-sm
                      bg-white text-[#543A14]
                      hover:bg-[#543A14]
                      hover:text-white
                      hover:border-[#543A14]
                      transition-all duration-300">

                Add To Cart

              </a>

              <a
                href="checkout.php?id=<?= $p['id']; ?>"
                class="flex-1 text-center
                      bg-black text-white
                      rounded-full py-2 text-sm
                      hover:bg-[#FFF0DC]
                      hover:text-[#543A14]
                      transition-all duration-300">

                Buy Now

              </a>

            </div>

          </a>

        </div>

      <?php endforeach; ?>

  </section>

</main>

<!-- VIEW -->
<div class="text-center mb-16">

  <a
    href="shop.php"
    class="bg-black text-white
            px-10 py-3
            rounded-full
            hover:bg-[#FFF0DC]
            hover:text-[#543A14]
            transition-all duration-300">

    View More

  </a>
</div>

<?php include 'components/footer.php'; ?>