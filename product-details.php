<?php include 'components/header.php'; ?>

<?php
$products = [
  ["image"=>"assets/images/shop/livingroom/mika-armchair.svg","name"=>"Mika Armchair","category"=>"Living Room","price"=>"$185.00"],
  ["image"=>"assets/images/shop/livingroom/mika-sofa.svg","name"=>"Mika Sectional Sofa","category"=>"Living Room","price"=>"$799.00"],
  ["image"=>"assets/images/shop/livingroom/sore-velvet.svg","name"=>"Sora Velvet Ottoman","category"=>"Living Room","price"=>"$120.00"],
  ["image"=>"assets/images/shop/livingroom/jute-rug.svg","name"=>"Taro Jute Rug","category"=>"Living Room","price"=>"$85.00"],
  ["image"=>"assets/images/shop/livingroom/dara-mirror.svg","name"=>"Dara Mirror","category"=>"Living Room","price"=>"$110.00"],
  ["image"=>"assets/images/shop/bedroom/nami-table.svg","name"=>"Nami Side Table","category"=>"Bedroom","price"=>"$89.00"],
  ["image"=>"assets/images/shop/bedroom/rumi-wardrobe.svg","name"=>"Rumi Wardrobe","category"=>"Bedroom","price"=>"$450.00"],
  ["image"=>"assets/images/shop/bedroom/nami-bed.svg","name"=>"Nami Bed Frame","category"=>"Bedroom","price"=>"$550.95"],
  ["image"=>"assets/images/shop/workspace/zora-lamp.svg","name"=>"Zora Desk Lamp","category"=>"Workspace","price"=>"$45.00"],
  ["image"=>"assets/images/shop/workspace/kala-desk.svg","name"=>"Kala Working Desk","category"=>"Workspace","price"=>"$320.00"],
  ["image"=>"assets/images/shop/workspace/sora-lamp.svg","name"=>"Sora Table Lamp","category"=>"Workspace","price"=>"$45.00"],
  ["image"=>"assets/images/shop/dining/finn-table.svg","name"=>"Finn Dining Table","category"=>"Dining","price"=>"$520.00"],
  ["image"=>"assets/images/shop/dining/mika-spoon.svg","name"=>"Mika Spoon Set","category"=>"Dining","price"=>"$44.00"],
];

$productName = $_GET['name'] ?? '';
$selectedProduct = null;

// cari produk
foreach ($products as $p) {
  if ($p['name'] === $productName) {
    $selectedProduct = $p;
    break;
  }
}

// fallback
if (!$selectedProduct) {
  $selectedProduct = $products[0];
}

// 🔥 RELATED PRODUCTS (3 RANDOM, TANPA PRODUK AKTIF)
$relatedProducts = array_filter($products, function($p) use ($selectedProduct) {
  return $p['name'] !== $selectedProduct['name'];
});

$relatedProducts = array_values($relatedProducts);
shuffle($relatedProducts);
$relatedProducts = array_slice($relatedProducts, 0, 3);
?>

<main>

  <!-- HERO -->
  <section class="w-full">
    <div class="relative w-full h-[200px] overflow-hidden">
      <img src="assets/images/background/bg-details.svg" class="w-full h-full object-cover">
      <div class="absolute inset-0 flex items-center justify-center text-white">
        <h1 class="text-3xl md:text-5xl font-bold">Products Details</h1>
      </div>
    </div>
  </section>


  <!-- DETAIL -->
  <section class="max-w-6xl mx-auto px-6 py-10">

    <a href="shop.php" class="text-sm text-gray-500 mb-6 inline-block">← Back</a>

    <div class="grid md:grid-cols-2 gap-10">

      <!-- IMAGE -->
      <div class="rounded-2xl p-6">
        <img src="<?= $selectedProduct['image']; ?>" class="w-full h-auto object-cover">
      </div>

      <!-- INFO -->
      <div>

        <p class="text-sm text-[#543A14] mb-2">
          <?= $selectedProduct['category']; ?>
        </p>

        <h1 class="text-[38px] md:text-3xl font-bold mb-3">
          <?= $selectedProduct['name']; ?>
        </h1>

        <p class="text-[#543A14] text-sm mb-6">
          A masterpiece of comfort and minimalist design. Crafted with premium upholstery and ergonomic support, making it the perfect centerpiece for your modern living room.
        </p>

        <p class="text-xl font-semibold mb-4">
          <?= $selectedProduct['price']; ?>
        </p>

        <!-- QUANTITY -->
        <div class="flex items-center gap-3 mb-6">
          <span class="text-sm text-[#543A14]">Quantity</span>
          <input type="number" value="1" class="w-16 border rounded px-2 py-1 text-center">
        </div>

        <!-- BUTTON -->
        <div class="flex gap-4">
          <button class="border border-[#543A14] px-6 py-2 rounded-full text-sm font-semibold text-[#543A14]">
            Add to Cart
          </button>

          <button class="bg-black text-white px-6 py-2 rounded-full text-sm">
            Buy Now
          </button>
        </div>

        <div class="mt-6 space-y-3 text-[#8B7355] text-sm">
            <!-- Item 1 -->
            <div class="flex items-center gap-3">
                <img src="assets/icons/delivery.svg" class="w-5 h-5 object-contain">
                <p>Free standard delivery on all orders</p>
            </div>

            <!-- Item 2 -->
            <div class="flex items-center gap-3">
                <img src="assets/icons/estimated.svg" class="w-5 h-5 object-contain">
                <p>Estimated delivery: 2-4 business days</p>
            </div>

            <!-- Item 3 -->
            <div class="flex items-center gap-3">
                <img src="assets/icons/location.svg" class="w-5 h-5 object-contain">
                <p>Available for shipping nationwide</p>
            </div>
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

        <a href="product-details.php?name=<?= urlencode($p['name']); ?>"
           class="bg-white rounded-2xl p-4 border border-[#F2F2F2] shadow-sm hover:shadow-md transition block">

          <div class="rounded-xl overflow-hidden p-2">
            <img src="<?= $p['image']; ?>" class="w-full h-auto object-cover rounded-lg">
          </div>

          <div class="mt-3 flex justify-between">
            <div>
              <h3 class="text-sm font-medium"><?= $p['name']; ?></h3>
              <p class="text-xs text-gray-400"><?= $p['category']; ?></p>
            </div>

            <p class="text-sm font-medium"><?= $p['price']; ?></p>
          </div>

          <div class="flex gap-2 mt-3">
            <button class="flex-1 border border-black rounded-full py-1 text-xs">Add to Cart</button>
            <button class="flex-1 bg-black text-white rounded-full py-1 text-xs">Buy Now</button>
          </div>

        </a>

      <?php endforeach; ?>

    </div>

  </section>

</main>

<?php include 'components/footer.php'; ?>