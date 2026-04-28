<?php include 'components/header.php'; ?>

<main class="bg-white">

    <!-- HERO -->
    <section class="w-full">
        <div class="relative w-full h-[200px] overflow-hidden">
        <img src="assets/images/background/bg-details.svg" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex items-center justify-center text-white">
            <h1 class="text-3xl md:text-5xl font-bold">Products Details</h1>
        </div>
        </div>
    </section>

  <!-- CONTAINER -->
  <section class="max-w-6xl mx-auto px-6 py-12 space-y-16">

    <!-- 🔥 LIVING ROOM -->
<div class="space-y-10">

  <!-- Header -->
  <div class="flex justify-between items-start gap-6">

    <!-- Text -->
    <div class="max-w-2xl">
      <h2 class="text-2xl md:text-[28px] font-bold text-[#1E1E1E]">
        Living Room Collection
      </h2>

      <p class="text-sm text-[#543A14] mt-3 leading-relaxed">
        Create a warm and welcoming living space with our collection of modern sofas, coffee tables, TV cabinets,
        and decorative furniture. Designed to combine comfort and functionality, each piece helps you build a
        relaxing environment perfect for gathering with family and friends.
      </p>
    </div>

    <!-- Button -->
    <a href="shop.php?category=living-room"
      class="bg-black text-white px-6 py-2.5 rounded-full text-sm whitespace-nowrap hover:opacity-90 transition">
      Shop Now
    </a>

  </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Image 1 -->
        <div class="rounded-2xl overflow-hidden">
            <img src="assets/images/categories/cat-1.svg" class="w-full h-auto">
        </div>

        <!-- Image 2 -->
        <div class="rounded-2xl overflow-hidden">
            <img src="assets/images/categories/cat-2.svg" class="w-full h-auto">
        </div>

        <!-- Image 3 -->
        <div class="rounded-2xl overflow-hidden">
            <img src="assets/images/categories/cat-3.svg" class="w-full h-auto">
        </div>
    </div>


    <!-- 🔥 DINING (RAMPING VERSION) -->
<div class="relative w-full h-[340px] md:h-[380px] overflow-hidden">

  <!-- Background -->
  <img 
    src="assets/images/categories/dining.svg" 
    class="w-full h-full object-cover"
  >

  <!-- Content -->
  <div class="absolute inset-0 flex items-center justify-end px-6 md:px-14">

    <div class="max-w-[440px] text-right">

      <h2 class="text-xl md:text-[26px] font-bold text-[#1E1E1E]">
        Dining Room Collection
      </h2>

      <p class="text-sm text-[#543A14] mt-6 leading-relaxed">
        Create a refined dining experience with our thoughtfully curated collection of tables, chairs, and storage pieces. Designed to balance comfort and sophistication, each item enhances your space while bringing people together to share meaningful moments over every meal.
      </p>

      <a href="shop.php?category=dining"
        class="inline-block mt-6 bg-black text-white px-5 py-2 rounded-full text-sm hover:opacity-90 transition">
        Shop Now
      </a>

    </div>

  </div>

</div>


    <!-- 🔥 BEDROOM -->
    <div class="grid md:grid-cols-2 gap-10 items-center">

      <!-- Text -->
      <div>
        <h2 class="text-2xl font-bold text-[#1E1E1E]">
          Bedroom Collection
        </h2>

        <p class="text-sm text-[#543A14] mt-6">
          Experience the perfect blend of comfort and elegance with our carefully crafted bedroom furniture, designed to transform your space into a personal sanctuary. Each piece is meticulously engineered from premium materials to foster a harmonious and restful environment, ensuring your bedroom remains the ultimate place to relax, recharge, and enjoy timeless style every single day.
        </p>

        <a href="shop.php?category=bedroom"
          class="mt-6 inline-block bg-black text-white px-5 py-2 rounded-full text-sm">
          Shop Now
        </a>
      </div>

      <!-- Image -->
      <img src="assets/images/categories/bedroom.svg"
        class="w-full rounded-2xl object-cover">

    </div>


    <!-- 🔥 WORKSPACE -->
<div class="grid md:grid-cols-2 items-stretch">

  <!-- Image -->
  <div>
    <img 
      src="assets/images/categories/workspace.svg"
      class="w-full h-full object-cover"
    >
  </div>

  <!-- Text -->
    <div class="bg-[#F5EDE3] flex flex-col justify-center items-center text-center px-10 md:px-14 py-10">

    <h2 class="text-2xl md:text-[28px] font-bold text-[#1E1E1E]">
        Workspace Collection
    </h2>

    <p class="text-sm text-[#543A14] mt-6 leading-relaxed max-w-md">
        Experience a new level of productivity with our thoughtfully designed workspace collection, where functionality meets sophisticated modern aesthetics. Each piece is crafted to support your focus and creativity, blending ergonomic comfort with high-quality materials to create an inspiring home office environment that empowers you to achieve your best work in total style.
    </p>

    <a href="shop.php?category=workspace"
        class="mt-6 inline-block bg-black text-white px-6 py-2.5 rounded-full text-sm hover:opacity-90 transition">
        Shop Now
    </a>

    </div>

</div>

  </section>

</main>

<?php include 'components/footer.php'; ?>