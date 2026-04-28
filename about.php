<?php include 'components/header.php'; ?>

<main>

  <!-- 🔥 HERO -->
  <section class="w-full">
    <div class="relative w-full h-[300px] md:h-[360px] overflow-hidden">

      <img 
        src="assets/images/background/bg-about.svg"
        class="w-full h-full object-cover"
      >

      <div class="absolute inset-0 flex items-center justify-center">
        <h1 class="text-white text-4xl md:text-[56px] font-semibold">
          About Us
        </h1>
      </div>

    </div>
  </section>


  <!-- 🔥 CONTENT -->
  <section class="py-16 bg-[#F5F5F5]">
    <div class="max-w-6xl mx-auto px-6">

      <div class="grid md:grid-cols-2">

        <!-- ROW 1 -->
        <div>
          <img src="assets/images/about/1.svg" class="w-full h-full object-cover">
        </div>

        <div class="bg-[#8B7355] text-white p-10 flex flex-col justify-center">
          <h2 class="text-2xl font-bold mb-4">
            The Domio Story
          </h2>

          <p class="text-sm leading-relaxed text-white/90">
            Domio was founded on the principle that furniture should be a perfect harmony of form, function, and emotion. 
            We believe that your living space is a sanctuary, and every piece within it should contribute to a sense of calm and inspiration.
          </p>

          <p class="text-sm leading-relaxed mt-4 text-white/90">
            Our collection is meticulously curated for those who appreciate minimalist aesthetics and refined modern living. 
            We ensure that our furniture does more than just fill a room—it defines the way you experience your home every single day.
          </p>
        </div>


        <!-- ROW 2 -->
        <div class="bg-[#EED9BD] p-10 flex flex-col justify-center">
          <h2 class="text-2xl font-bold mb-4 text-[#1E1E1E]">
            Crafted With Intention
          </h2>

          <p class="text-sm leading-relaxed text-[#543A14]">
            We are deeply committed to the art of craftsmanship and the use of honest, premium materials. 
            By collaborating with skilled artisans, we ensure that every detail meets the highest standards of durability and timeless style.
          </p>

          <p class="text-sm leading-relaxed mt-4 text-[#543A14]">
            From the solid wood grain to the delicate weave of our fabrics, quality is at the heart of everything we do. 
            We create sustainable pieces that are designed to age gracefully alongside your home and your family.
          </p>
        </div>

        <div>
          <img src="assets/images/about/2.svg" class="w-full h-full object-cover">
        </div>


        <!-- ROW 3 -->
        <div>
          <img src="assets/images/about/3.svg" class="w-full h-full object-cover">
        </div>

        <div class="bg-[#8B7355] text-white p-10 flex flex-col justify-center">
          <h2 class="text-2xl font-bold mb-4">
            A Modern Classic
          </h2>

          <p class="text-sm leading-relaxed text-white/90">
            Our design language is rooted in minimalism and natural warmth. 
            Stripping away the unnecessary to let the beauty of raw materials shine, we believe that luxury lies in simplicity and thoughtful proportion.
          </p>

          <p class="text-sm leading-relaxed mt-4 text-white/90">
            Whether it is an elegant dining table or a refined bed frame, Domio is defined by a refined aesthetic that fits effortlessly into any interior. 
            We invite you to create a home that reflects a life well-lived.
          </p>
        </div>

      </div>

    </div>
  </section>

</main>

<?php include 'components/footer.php'; ?>