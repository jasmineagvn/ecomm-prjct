<?php include 'components/header.php' ?>

<main>

     <!-- Start: Hero -->
  <div class="hero relative">
    <img src="assets/images/bg-kontak.png" alt="" class="w-full h-auto object-cover">
    <div class="absolute inset-0 px-4 md:px-0 flex flex-col gap-5 items-center mx-auto justify-center w-full md:w-[827px]">
      <h1 class="text-4xl md:text-[50px] font-bold tracking-[-0.7px] text-center text-white">
        Kontak Informasi
      </h1>
      <p class="text-sm md:text-base text-white text-center w-full md:w-[700px]">
       Janji Baik selalu siap merespons, baik untuk pertanyaan, masukan, atau sekadar sapaan.
      </p>  
    </div>
  </div>
  <!-- End: Hero -->


     <div class="bg-[#eaf9fa] rounded-2xl p-8 shadow-lg mb-20 max-w-6xl mx-auto mt-20">
        <div class="flex flex-col md:flex-row gap-10">
            <!-- Contact Details -->
            <div class="flex-1 flex flex-col gap-6 w-full lg:w-1/2 pr-4">
                <div class="bg-white w-full lg:w-[400px] rounded-xl p-4 shadow-lg flex items-start gap-4">
                    <img src="assets/images/kontakkami/call.png" alt="No. HP" class="w-6 h-6 mt-1">
                    <div>
                        <h4 class="font-semibold text-[#72717B]">No. HP (Admin)</h4>
                        <p class="text-sm text-gray-600">0817-170-422</p>
                    </div>
                </div>
                <div class="bg-white w-full lg:w-[400px] rounded-xl p-4 shadow-lg flex items-start gap-4">
                    <img src="assets/images/kontakkami/gmail.png" alt="Email" class="w-6 h-6 mt-1">
                    <div>
                        <h4 class="font-semibold text-[#72717B]">Email</h4>
                        <p class="text-sm text-gray-600">janji.baikmedia@gmail.com</p>
                    </div>
                </div>
                <div class="bg-white w-full lg:w-[400px] rounded-xl p-4 shadow-lg flex items-start gap-4">
                    <img src="assets/images/kontakkami/lokasi.png" alt="Lokasi" class="w-6 h-6 mt-1">
                    <div>
                        <h4 class="font-semibold text-[#72717B]">Lokasi</h4>
                        <p class="text-sm text-gray-600">Alesha House, Vanya Park, Tangerang Regency, Banten</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="flex-1 w-full lg:w-1/2 pl-0 lg:pl-4">
                <h2 class="text-2xl font-bold mb-1">Kirim Pesan</h2>
                <p class="text-gray-600 text-sm mb-6">
                    Silahkan isi formulir dibawah ini, dan kami akan segera menghubungi Anda
                </p>
                <form id="whatsappForm" class="space-y-4">
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Ketik nama" 
                        class="bg-white w-full border border-gray-300 rounded-lg p-3 focus:outline-none"
                        required>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        class="bg-white w-full border border-gray-300 rounded-lg p-3 focus:outline-none"
                        required>
                    <input 
                        type="text" 
                        name="phone" 
                        placeholder="No. HP / WhatsApp" 
                        class="bg-white w-full border border-gray-300 rounded-lg p-3 focus:outline-none"
                        required>
                    <textarea 
                        name="message" 
                        placeholder="Ketik Pesan" 
                        class="bg-white w-full border border-gray-300 rounded-lg p-3 h-[190px] resize-none focus:outline-none"
                        required></textarea>
                    <button 
                        type="submit" 
                        class="bg-[#EC901D] hover:bg-orange-600 text-white px-6 py-2 rounded-full w-[187px] cursor-pointer">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <section class="py-12 bg-white text-center px-5 lg:px-0">
      <h2 class="text-4xl font-bold text-gray-900 mb-4">
        Temukan Kami Di Google Maps
      </h2>
      <p class="text-gray-600 mb-8">
        Kunjungi Lokasi Janji Baik dan Kami Siap Menyambut Anda Secara Langsung
      </p>

      <div class="flex justify-center">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.782424645917!2d106.61430907355545!3d-6.292301061583622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fbdc511cb5bd%3A0xa230ec5d9fc94409!2sJanji%20Baik!5e0!3m2!1sen!2sid!4v1746089697175!5m2!1sen!2sid"
          class="w-full max-w-5xl h-[450px] shadow-md"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </section>
    <script>
    document.getElementById("whatsappForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const name = document.querySelector('input[name="name"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const phone = document.querySelector('input[name="phone"]').value;
        const message = document.querySelector('textarea[name="message"]').value;

        const formattedMessage = `Halo Admin, saya ingin menghubungi Anda.%0A%0A*Nama:* ${name}%0A*Email:* ${email}%0A*No HP:* ${phone}%0A*Pesan:* ${message}`;
        
        const waNumber = "6281216925113"; // Tanpa "+" ganti 0 jadi 62

        window.open(`https://wa.me/${waNumber}?text=${formattedMessage}`, '_blank');

         // Setelah itu, reset form
        document.getElementById("whatsappForm").reset();
    });
    </script>
</main>

<?php include 'components/footer.php' ?>