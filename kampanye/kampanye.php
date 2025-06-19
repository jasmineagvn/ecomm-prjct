<?php require __DIR__ . '/data.php'; ?>
<?php include '../components/header.php' ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kampanye Janji Baik</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="py-16 px-4 max-w-6xl mx-auto">
    <h2 class="text-4xl lg:text-[50px] font-bold text-center mb-4 leading-tight">
      Kampanye Janji Baik
    </h2>
    <p class="text-center text-sm lg:text-base text-gray-600 w-full lg:w-[844px] mx-auto mb-20">
      Janji Baik adalah gerakan untuk menciptakan masa depan yang lebih adil
        dan penuh harapan bagi anak-anak Indonesia. Melalui program pendidikan
        inklusif, ruang belajar yang aman dan suportif, serta perhatian pada
        kesehatan mental, kami mendampingi mereka untuk tumbuh dengan utuh.
        Kampanye ini juga mengajak masyarakat terlibat dalam membangun
        kesejahteraan sosial melalui aksi-aksi yang menumbuhkan empati,
        kolaborasi, dan kepedulian terhadap lingkungan. Bersama, kita bisa
        menjadikan setiap janji sebagai nyata—bagi mereka yang membutuhkan ruang
        untuk tumbuh dan bermimpi.
    </p>

    <div class="max-w-6xl mx-auto mt-5 flex flex-wrap justify-center gap-5">
      <?php foreach ($campaigns as $item): ?>
        <div class="flex lg:flex-row flex-col bg-white shadow-lg gap-14 w-full p-6 rounded-2xl">
          <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>" class="aspect-video w-full lg:w-[300px] object-cover rounded-xl" />
          <div class="p-4 flex-1">
            <p class="text-sm text-[#01B4BB] font-medium mb-1"><?= $item['tag'] ?></p>
            <h2 class="text-[30px] font-bold mb-4"><?= $item['title'] ?></h2>
            <?php 
              $percentage = ($item['collected'] / $item['target']) * 100;
            ?>
            <div class="w-full bg-gray-200 h-2 rounded-full mt-2 mb-4">
              <div class="bg-cyan-600 h-2 rounded-full" style="width: <?= $percentage ?>%;"></div>
            </div>
            <div class="text-sm text-gray-500 mb-2">
              Terkumpul <strong>Rp<?= number_format($item['collected'], 0, ',', '.') ?></strong> 
              dari <strong>Rp<?= number_format($item['target'], 0, ',', '.') ?></strong>
            </div>
            <a href="detailkampanye.php?id=<?= $item['id'] ?>" 
              class="bg-orange-400 hover:bg-orange-500 text-white text-sm lg:text-base px-6 py-2 rounded-full w-[240px] h-[39px] inline-block text-center mt-8">
              Lihat Detail Kampanye
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="flex justify-center">
      <div class="mt-20 w-[881px] h-[260px] bg-[#01B4BB] rounded-[55px] text-white text-center py-12 px-4">
        <p class="font-semibold text-lg lg:text-[24px] mb-2">
          Kami sudah melangkah lebih dulu. Sekarang giliranmu!
        </p>
        <p class="mb-10 text-base lg:text-[24px] font-bold">
          Apa aksi baikmu yang akan kamu mulai hari ini?
        </p>
        <a href="../forms/kolaborasi_form.php" 
          class="bg-orange-400 hover:bg-orange-500 text-white text-sm lg:text-base font-semibold px-8 py-4 mt-2 rounded-full inline-block">
          Buat Aksi Baik Kamu, Yuk!
        </a>
      </div>
    </div>
  </div>
</body>
</html>

<?php include '../components/footer.php' ?>