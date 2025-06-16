<?php include 'components/header.php'; ?>

<main>
  <div class="min-h-screen flex flex-col items-center justify-center px-6 text-center">
    <h1 class="text-2xl md:text-3xl font-bold mb-6 mt-10">
      Yeay! Pendaftaranmu sudah berhasil dikirim! <br />
      Selamat datang di keluarga besar <span class="text-[#01B4BB]">Janji Baik</span>!
    </h1>

    <img
      src="assets/images/successpage/siswa.png"
      alt="Terima Kasih"
      class="w-full md:w-80 mb-8"
    />

    <p class="max-w-xl text-base md:text-lg mb-10 text-[#72717B]">
      Terima kasih sudah mempercayai Janji Baik sebagai tempat belajarmu!
      Tim kami akan segera menghubungimu dalam 1-3 hari kerja untuk proses selanjutnya.
      <br /><br />
      Pantau terus WhatsApp dan email kamu ya! Perjalanan belajar yang seru menanti! 📚✨
    </p>

    <div class="flex flex-col sm:flex-row gap-4">
      <a
        href="/janji-baik/forms/syarat_siswa.php"
        class="bg-[#01B4BB] text-white px-6 py-2 rounded-full hover:bg-teal-600 transition"
      >
        Lihat Syarat & Ketentuan
      </a>
      <a
        href="/janji-baik/index.php"
        class="bg-orange-400 text-white px-6 py-2 rounded-full hover:bg-orange-500 transition"
      >
        Kembali ke Beranda
      </a>
    </div>

    <div class="mt-8 p-4 bg-blue-50 rounded-lg max-w-md">
      <h3 class="font-semibold text-[#01B4BB] mb-2">Langkah Selanjutnya:</h3>
      <ul class="text-sm text-gray-600 text-left space-y-1">
        <li>✓ Tunggu konfirmasi dari tim Janji Baik</li>
        <li>✓ Siapkan dokumen yang diperlukan</li>
        <li>✓ Ikuti proses orientasi siswa baru</li>
      </ul>
    </div>
  </div>
</main>

<?php include 'components/footer.php'; ?>