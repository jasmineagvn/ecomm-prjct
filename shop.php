<?php include 'components/header.php'; ?>

<?php
$products = [
  ["image"=>"assets/images/shop/livingroom/mika-armchair.svg",
    "name"=>"Mika Armchair",
    "category"=>"living-room",
    "price"=>"$185.00"
  ],
  ["image"=>"assets/images/shop/livingroom/mika-sofa.svg",
    "name"=>"Mika Sectional Sofa",
    "category"=>"living-room",
    "price"=>"$799.00"
  ],
  ["image"=>"assets/images/shop/livingroom/sore-velvet.svg",
    "name"=>"Sora Velvet Ottoman",
    "category"=>"living-room",
    "price"=>"$120.00"
  ],
  ["image"=>"assets/images/shop/livingroom/jute-rug.svg",
    "name"=>"Taro Jute Rug",
    "category"=>"living-room",
    "price"=>"$85.00"
  ],
  ["image"=>"assets/images/shop/livingroom/dara-mirror.svg",
    "name"=>"Dara Mirror",
    "category"=>"living-room",
    "price"=>"$110.00"
  ],
  ["image"=>"assets/images/shop/bedroom/nami-table.svg",
    "name"=>"Nami Side Table",
    "category"=>"bedroom",
    "price"=>"$89.00"
  ],
  ["image"=>"assets/images/shop/bedroom/rumi-wardrobe.svg",
    "name"=>"Rumi Wardrobe",
    "category"=>"bedroom",
    "price"=>"$450.00"
  ],
  ["image"=>"assets/images/shop/bedroom/nami-bed.svg",
    "name"=>"Nami Bed Frame",
    "category"=>"bedroom",
    "price"=>"$550.95"
  ],
  ["image"=>"assets/images/shop/workspace/zora-lamp.svg",
    "name"=>"Zora Desk Lamp",
    "category"=>"workspace",
    "price"=>"$45.00"
  ],
  ["image"=>"assets/images/shop/workspace/kala-desk.svg",
    "name"=>"Kala Working Desk",
    "category"=>"workspace",
    "price"=>"$320.00"
  ],
  ["image"=>"assets/images/shop/workspace/sora-lamp.svg",
    "name"=>"Sora Table Lamp",
    "category"=>"workspace",
    "price"=>"$45.00"
  ],
  ["image"=>"assets/images/shop/dining/finn-table.svg",
    "name"=>"Finn Dining Table",
    "category"=>"dining",
    "price"=>"$520.00"
  ],
  ["image"=>"assets/images/shop/dining/mika-spoon.svg",
    "name"=>"Mika Spoon Set",
    "category"=>"dining",
    "price"=>"$44.00"
  ],
];
$search = $_GET['search'] ?? '';
?>

<main>

  <!-- HERO -->
  <section class="w-full">
    <div class="relative w-full h-[400px] overflow-hidden">
      <img src="assets/images/background/bg-shop.svg" class="w-full h-full object-cover">

      <div class="absolute inset-0 flex items-center justify-center text-white">
        <h1 class="text-4xl md:text-[64px] font-bold">The Shop</h1>
      </div>
    </div>
  </section>


  <!-- CATEGORY FILTER -->
  <section class="py-8">
    <div class="max-w-7xl mx-auto px-6">

      <div class="flex flex-wrap justify-center gap-8 text-sm md:text-base">

        <button class="filter-btn text-[#D9A86C] font-medium" data-category="all">All</button>
        <button class="filter-btn text-[#2D2D2D]" data-category="living-room">Living Room</button>
        <button class="filter-btn text-[#2D2D2D]" data-category="bedroom">Bedroom</button>
        <button class="filter-btn text-[#2D2D2D]" data-category="workspace">Workspace</button>
        <button class="filter-btn text-[#2D2D2D]" data-category="dining">Dining</button>

      </div>

    </div>
  </section>


  <!-- PRODUCT GRID -->
  <section class="pb-20">
    <div class="max-w-7xl mx-auto px-6">

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach ($products as $product): ?>
          <?php
            if ($search && stripos($product['name'], $search) === false) {
              continue;
            }
          ?>
          <a 
            href="product-details.php?name=<?= urlencode($product['name']); ?>"
            class="product-card bg-white rounded-2xl p-4 border border-[#F2F2F2] shadow-[7px_70px_70px_rgba(0,0,0,0.12)] transition-all duration-300 block"
            data-category="<?= $product['category']; ?>"
          >

            <!-- IMAGE -->
            <div class="rounded-xl overflow-hidden p-2">
              <img 
                src="<?= $product['image']; ?>"
                alt="<?= $product['name']; ?>"
                class="w-full h-auto object-cover rounded-lg"
              >
            </div>

            <!-- INFO -->
            <div class="mt-4">
              <div class="flex justify-between items-start gap-3">

                <div>
                  <h3 class="text-sm font-medium text-[#1E1E1E]">
                    <?= $product['name']; ?>
                  </h3>

                  <p class="text-xs text-gray-500 mt-1">
                    <?= $product['category']; ?>
                  </p>
                </div>

                <p class="text-sm font-medium text-[#1E1E1E] whitespace-nowrap">
                  <?= $product['price']; ?>
                </p>

              </div>

              <!-- BUTTON -->
              <div class="flex gap-2 mt-4">

                <button class="flex-1 border border-gray-300 rounded-full py-2 text-xs hover:bg-gray-100 transition">
                  Add to Cart
                </button>

                <button class="flex-1 bg-black text-white rounded-full py-2 text-xs hover:opacity-90 transition">
                  Buy Now
                </button>

              </div>
            </div>
          </a>
        <?php endforeach; ?>

      </div>
    </div>
  </section>

</main>


<script>
  const buttons = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.product-card');

  const urlParams = new URLSearchParams(window.location.search);
  const activeCategoryFromURL = urlParams.get('category') || "all";

  function applyFilter(category) {

    // FILTER CARD
    cards.forEach(card => {
      if (category === "all" || card.dataset.category === category) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });

    // RESET BUTTON STYLE
    buttons.forEach(b => {
      b.classList.remove('text-[#D9A86C]', 'font-medium');
      b.classList.add('text-[#2D2D2D]');
    });

    // ACTIVE BUTTON
    buttons.forEach(b => {
      if (b.dataset.category === category) {
        b.classList.add('text-[#D9A86C]', 'font-medium');
      }
    });
  }

  // LOAD PERTAMA
  applyFilter(activeCategoryFromURL);

  // CLICK EVENT
  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      const category = btn.dataset.category;

      applyFilter(category);

      // update URL
      history.pushState(null, "", "?category=" + category);
    });
  });
</script>

<?php include 'components/footer.php'; ?>