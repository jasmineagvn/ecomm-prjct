<?php include 'components/header.php'; ?>

<?php

require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$category = $_GET['category'] ?? '';
$search = trim($_GET['search'] ?? '');

$params = [];

$query = "
    SELECT *
    FROM products
    WHERE 1=1
";

if (!empty($category)) {

  $query .= "
        AND LOWER(REPLACE(category,' ','-')) = ?
    ";

  $params[] = $category;
}

if (!empty($search)) {

  $query .= "
        AND (
            name LIKE ?
            OR category LIKE ?
            OR description LIKE ?
        )
    ";

  $params[] = "%$search%";
  $params[] = "%$search%";
  $params[] = "%$search%";
}

$query .= " ORDER BY id DESC";

$stmt = $db->prepare($query);
$stmt->execute($params);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main>

  <!-- HERO -->
  <section class="w-full">
    
    <div class="relative w-full h-[350px] overflow-hidden">

      <img
        src="assets/images/background/bg-shop.svg"
        alt="Shop Banner"
        class="w-full h-full object-cover">

      <div class="absolute inset-0 flex items-center justify-center">

        <h1 class="text-white text-5xl md:text-7xl font-bold">
          The Shop
        </h1>

      </div>

    </div>
  </section>

  <?php if (!empty($search)): ?>

    <section class="pt-8">

      <div class="max-w-7xl mx-auto px-6">

        <p class="text-[#543A14]">

          Search result for:

          <span class="font-semibold">
            "<?= htmlspecialchars($search) ?>"
          </span>

        </p>

      </div>

    </section>

  <?php endif; ?>

  <!-- CATEGORY -->
  <section class="py-10">

    <div class="max-w-7xl mx-auto px-6">

      <div class="flex justify-center flex-wrap gap-8">

        <a
          href="shop.php"
          class="<?= empty($category) ? 'text-[#D9A86C] font-medium' : '' ?>">
          All
        </a>

        <a
          href="shop.php?category=living-room"
          class="<?= $category == 'living-room' ? 'text-[#D9A86C] font-medium' : '' ?>">
          Living Room
        </a>

        <a
          href="shop.php?category=bedroom"
          class="<?= $category == 'bedroom' ? 'text-[#D9A86C] font-medium' : '' ?>">
          Bedroom
        </a>

        <a
          href="shop.php?category=workspace"
          class="<?= $category == 'workspace' ? 'text-[#D9A86C] font-medium' : '' ?>">
          Workspace
        </a>

        <a
          href="shop.php?category=dining"
          class="<?= $category == 'dining' ? 'text-[#D9A86C] font-medium' : '' ?>">
          Dining
        </a>

      </div>

    </div>

  </section>

  <!-- PRODUCTS -->
  <section class="pb-20">

    <div class="max-w-7xl mx-auto px-6">

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php if (count($products) > 0): ?>

          <?php foreach ($products as $product): ?>

            <div
              class="bg-white rounded-[24px] border border-[#F0F0F0] p-5 shadow-sm hover:shadow-lg transition duration-300">

              <!-- IMAGE -->
              <a href="product-details.php?id=<?= $product['id']; ?>">

                <div class="bg-[#FAFAFA] rounded-[20px] h-[280px] flex items-center justify-center overflow-hidden">

                  <img
                    src="<?= htmlspecialchars($product['image']); ?>"
                    alt="<?= htmlspecialchars($product['name']); ?>"
                    class="max-h-[220px] max-w-[220px] object-contain hover:scale-105 transition duration-300">

                </div>

              </a>

              <!-- INFO -->
              <div class="mt-5">

                <div class="flex justify-between items-start">

                  <div>

                    <h3 class="font-medium text-[#1E1E1E] hover:text-[#543A14] transition">

                      <a href="product-details.php?id=<?= $product['id']; ?>">

                        <?= htmlspecialchars($product['name']); ?>

                      </a>

                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                      <?= htmlspecialchars($product['category']); ?>
                    </p>

                  </div>

                  <p class="font-semibold text-[#1E1E1E]">
                    $<?= number_format($product['price'], 2); ?>
                  </p>

                </div>

                <div class="flex gap-3 mt-5">

                  <a
                    href="add-to-cart.php?id=<?= $product['id']; ?>"
                    class="flex-1 border border-[#D6CFC7]
                          rounded-full py-2 text-sm text-center
                          bg-white text-[#543A14]
                          hover:bg-[#543A14]
                          hover:text-white
                          hover:border-[#543A14]
                          hover:-translate-y-0.5
                          transition-all duration-300">

                    Add To Cart

                  </a>

                  <a
                    href="product-details.php?id=<?= $product['id']; ?>"
                    class="flex-1 bg-black text-white
                          rounded-full py-2 text-sm text-center
                          hover:bg-[#FFF0DC]
                          hover:text-[#543A14]
                          hover:-translate-y-0.5
                          transition-all duration-300">

                    Buy Now

                  </a>

                </div>

              </div>

            </div>

          <?php endforeach; ?>

        <?php else: ?>

          <div class="col-span-3 text-center py-20">

            <h2 class="text-xl text-gray-500">
              No products match your search.
            </h2>

          </div>

        <?php endif; ?>

      </div>

    </div>

  </section>

</main>

<?php include 'components/footer.php'; ?>