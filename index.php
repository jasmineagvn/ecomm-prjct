<?php include 'components/header.php' ?>

<main class="">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.6.2/countUp.umd.js"></script>

  <!-- Start : Hero -->
    <div class="hero relative">
      <img src="assets/images/background/bg-homee.svg" alt="" class="">
      <!-- Content -->
      <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">

        <!-- Small Text -->
        <p class="text-sm md:text-base font-normal mb-2">
          Domio Exclusive
        </p>

        <!-- Main Heading -->
        <h1 class="text-5xl md:text-[72px] font-bold leading-tight">
          The Art of Living
        </h1>

        <!-- Subtitle -->
        <p class="text-base md:text-lg mt-3 mb-8">
          Elevating your home with thoughtful artistry.
        </p>

        <!-- Button -->
        <a 
          href="shop.php"
          class="bg-[#FFF0DC] text-[#543A14] px-10 py-3 rounded-full text-base font-medium hover:bg-[#f5dfbc] transition"
        >
          Explore Now
        </a>
      </div>
    </div>
    <!-- End : Start -->

    <!-- Start : Our Story -->
  <section class="max-w-6xl mx-auto px-4 lg:px-0 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 bg-white gap-10 items-center">

      <!-- Left Image -->
      <div>
        <img 
          src="/ecomm-prjct/assets/images/home/our-story.svg" 
          alt="Our Story"
          class="w-full h-[335px] object-cover rounded-md"
        >
      </div>

      <!-- Right Content -->
      <div class="flex flex-col justify-between h-full">

        <div>
          <h2 class="text-4xl font-semibold text-[#1E1E1E] mb-5">
            Our Story
          </h2>

          <p class="text-[#5C5C5C] leading-relaxed text-base mb-6 max-w-xl">
            Founded in 2019, Domio has been dedicated to bringing high-quality,
            sustainable furniture to every home. We believe that a well-designed
            space can inspire better living and lasting memories.
          </p>

          <a 
            href="about.php"
            class="text-[#D89A47] font-bold font-medium hover:underline"
          >
            Read More
          </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-12 mt-12">

          <div>
            <h3 id="count1" class="text-5xl font-bold text-[#1E1E1E]">
              0
            </h3>
            <p class="text-[#543A14] mt-2 leading-snug">
              Curated <br> Products
            </p>
          </div>

          <div>
            <h3 id="count2" class="text-5xl font-bold text-[#1E1E1E]">
              0
            </h3>
            <p class="text-[#543A14] mt-2 leading-snug">
              Happy <br> Homes
            </p>
          </div>

          <div>
            <h3 id="count3" class="text-5xl font-bold text-[#1E1E1E]">
              0
            </h3>
            <p class="text-[#543A14] mt-2 leading-snug">
              Years <br> of Craft
            </p>
          </div>

        </div>

      </div>
    </div>
  </section>
  <!-- End : Our Story -->


  <!-- CountUp JS -->
  <script>
    window.addEventListener("load", () => {
      const count1 = new countUp.CountUp('count1', 500, {
        suffix: '+',
        duration: 2
      });

      const count2 = new countUp.CountUp('count2', 15, {
        suffix: 'k',
        duration: 2
      });

      const count3 = new countUp.CountUp('count3', 7, {
        duration: 2
      });

      count1.start();
      count2.start();
      count3.start();
    });
  </script>

  <!-- Start : Best Seller Product -->
  <section class="w-full bg-[#FFF8EE] mt-10 lg:mt-16 py-14">

  <!-- Container -->
  <div class="max-w-7xl mx-auto px-8 md:px-12">

    <!-- Heading -->
    <div class="mb-10">
      <h2 class="text-3xl md:text-[42px] font-semibold text-[#1E1E1E] mb-2">
        Our Best Seller Product
      </h2>

      <p class="text-[#543A14] text-sm md:text-base font-medium mt-4">
        Discover the most loved pieces that define modern comfort and timeless style in every home.
      </p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

      <!-- Item 1 -->
      <div class="text-center group">
        <div class="overflow-hidden rounded-2xl bg-white">
          <img 
            src="assets/images/home/best-product-1.svg"
            alt="Oda Ceramic Vase"
            class="w-full h-[180px] md:h-[200px] object-cover group-hover:scale-105 transition duration-300"
          >
        </div>

        <h3 class="mt-4 text-base md:text-lg font-medium text-[#1E1E1E]">
          Oda Ceramic Vase
        </h3>

        <p class="text-[#555] mt-1">
          $24.95
        </p>
      </div>

      <!-- Item 2 -->
      <div class="text-center group">
        <div class="overflow-hidden rounded-2xl bg-white">
          <img 
            src="assets/images/home/best-product-2.svg"
            alt="Lune Linen Pillow"
            class="w-full h-[180px] md:h-[200px] object-cover group-hover:scale-105 transition duration-300"
          >
        </div>

        <h3 class="mt-4 text-base md:text-lg font-medium text-[#1E1E1E]">
          Lune Linen Pillow
        </h3>

        <p class="text-[#555] mt-1">
          $19.99
        </p>
      </div>

      <!-- Item 3 -->
      <div class="text-center group">
        <div class="overflow-hidden rounded-2xl bg-white">
          <img 
            src="assets/images/home/best-product-3.svg"
            alt="Sora Table Lamp"
            class="w-full h-[180px] md:h-[200px] object-cover group-hover:scale-105 transition duration-300"
          >
        </div>

        <h3 class="mt-4 text-base md:text-lg font-medium text-[#1E1E1E]">
          Sora Table Lamp
        </h3>

        <p class="text-[#555] mt-1">
          $45.00
        </p>
      </div>

      <!-- Item 4 -->
      <div class="text-center group">
        <div class="overflow-hidden rounded-2xl bg-white">
          <img 
            src="assets/images/home/best-product-4.svg"
            alt="Teak Serving Tray"
            class="w-full h-[180px] md:h-[200px] object-cover group-hover:scale-105 transition duration-300"
          >
        </div>

        <h3 class="mt-4 text-base md:text-lg font-medium text-[#1E1E1E]">
          Teak Serving Tray
        </h3>

        <p class="text-[#555] mt-1">
          $29.99
        </p>
      </div>

    </div>

  </div>
</section>
  <!-- End : Best Seller Product -->

    <?php
$products = [
  [
    "name" => "Mika Armchair",
    "price" => "$185.00",
    "category" => "Living Room",
    "image" => "assets/images/home/our-collect-1.svg",
  ],
  [
    "name" => "Nami Side Table",
    "price" => "$89.00",
    "category" => "Bedroom",
    "image" => "assets/images/home/our-collect-2.svg",
  ],
  [
    "name" => "Kala Working Desk",
    "price" => "$320.00",
    "category" => "Workspace",
    "image" => "assets/images/home/our-collect-3.svg",
  ],
  [
    "name" => "Selo Dining Chair",
    "price" => "$115.00",
    "category" => "Dining",
    "image" => "assets/images/home/our-collect-4.svg",
  ],
  [
    "name" => "Rumi Wardrobe",
    "price" => "$450.00",
    "category" => "Bedroom",
    "image" => "assets/images/home/our-collect-5.svg",
  ],
  [
    "name" => "Hana Floor Lamp",
    "price" => "$120.00",
    "category" => "Living Room",
    "image" => "assets/images/home/our-collect-6.svg",
  ],
];
?>

<!-- Start : Explore Collections -->
<section class="max-w-6xl mx-auto mt-16 lg:mt-24 px-4">

  <!-- Title -->
  <div class="text-center">
    <h2 class="text-3xl md:text-[42px] font-semibold text-[#1E1E1E]">
      Explore Our Collections
    </h2>
  </div>

  <!-- Category -->
  <div class="flex flex-wrap justify-center gap-3 mt-6 mb-10">

    <button class="px-7 py-2 rounded-full bg-black text-white text-sm">
      All
    </button>

    <button class="px-6 py-2 rounded-full border border-black text-sm">
      Living Room
    </button>

    <button class="px-6 py-2 rounded-full border border-black text-sm">
      Bedroom
    </button>

    <button class="px-6 py-2 rounded-full border border-black text-sm">
      Workspace
    </button>

    <button class="px-6 py-2 rounded-full border border-black text-sm">
      Dining
    </button>

  </div>

  <!-- Product Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

    <?php foreach($products as $item): ?>
    <div class="bg-white rounded-3xl border border-[#EEEEEE] p-4 hover:shadow-xl transition duration-300">

      <!-- Image -->
      <div class="bg-[#FAFAFA] rounded-3xl overflow-hidden">
        <img 
          src="<?= $item['image']; ?>" 
          alt="<?= $item['name']; ?>"
          class="w-full h-[240px] object-cover transition duration-300"
        >
      </div>

      <!-- Content -->
      <div class="pt-4">
        <div class="flex justify-between items-start gap-3">
          <h3 class="text-lg font-medium text-[#1E1E1E]">
            <?= $item['name']; ?>
          </h3>

          <span class="text-[#1E1E1E] font-medium">
            <?= $item['price']; ?>
          </span>
        </div>

        <p class="text-sm text-[#777] mt-1">
          <?= $item['category']; ?>
        </p>

        <!-- Button -->
        <div class="flex gap-3 mt-5">

          <a href="#" class="w-1/2 text-center border border-black py-2 rounded-full text-sm hover:bg-gray-100 transition">
            Add to Cart
          </a>

          <a href="#" class="w-1/2 text-center bg-black text-white py-2 rounded-full text-sm hover:bg-[#222] transition">
            Buy Now
          </a>

        </div>
      </div>

    </div>
    <?php endforeach; ?>

  </div>

</section>
<!-- End : Explore Collections -->

</main>

<?php include 'components/footer.php' ?>

