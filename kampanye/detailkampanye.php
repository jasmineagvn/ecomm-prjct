<?php include '../components/header.php' ?>
<?php
// Simulasi data kampanye dari data array (seperti file kampanyeDetailData.js)
$campaigns = [
    [
        "id" => "1",
        "image" => "../assets/images/kampanyedetail/pendidikan.png",
        "tag" => "Donasi Kampanye Tetap",
        "title" => "Pendidikan untuk Anak Hebat Sekolah Janji Baik",
        "collected" => 3000000,
        "target" => 5000000,
        "daysLeft" => 20,
        "description" => "Setiap anak terlahir dengan potensi untuk menjadi hebat, namun tidak semua memiliki kesempatan yang sama untuk mengejar impian mereka. Di banyak tempat, anak-anak masih harus belajar dalam keterbatasan—bukan karena kurangnya semangat, tetapi karena minimnya fasilitas dasar seperti alat tulis yang layak. Padahal, pendidikan yang berkualitas sering kali dimulai dari hal-hal kecil seperti buku catatan, pensil, dan penghapus. Sekolah Janji Baik hadir sebagai ruang belajar yang aman dan penuh harapan bagi anak-anak dari keluarga kurang mampu. Selain memberikan pelajaran akademis, sekolah ini menanamkan nilai-nilai seperti rasa percaya diri dan semangat pantang menyerah. Sayangnya, banyak dari mereka masih datang ke sekolah dengan alat tulis seadanya, bahkan harus berbagi perlengkapan dengan teman sebangku.Melalui kampanye “Pendidikan untuk Anak Hebat”, kami mengajak masyarakat untuk mendukung semangat belajar anak-anak ini dengan menyediakan alat tulis seperti buku tulis, pensil, pulpen, dan perlengkapan lainnya. Bantuan Anda akan sangat berarti dalam mendukung proses belajar mereka agar lebih layak, nyaman, dan penuh semangat. Bersama, mari kita bantu mereka menulis masa depan yang lebih cerah.",
        "storyImages" => [
            "../assets/images/kampanyedetail/pendidikan1.png",
            "../assets/images/kampanyedetail/pendidikan2.png",
            "../assets/images/kampanyedetail/pendidikan3.png",
        ],
        "uniqueCode" => "123",
        "bankAccount" => [
            "number" => "8991 - 3161 - 91",
            "accountName" => "Yayasan Sekolah Janji Baik",
            "uniqueCode" => "10",
        ],
    ],
    [
        "id" => "2",
        "image" => "../assets/images/kampanyedetail/wisuda.jpg",
        "tag" => "Donasi Kampanye Terbatas/Sekilas",
        "title" => "Harapan yang Lulus Bersama Waktu – Wisuda di Sekolah Janji Baik",
        "collected" => 3000000,
        "target" => 5000000,
        "daysLeft" => 12,
        "description" => "Hari wisuda di Sekolah Janji Baik adalah momen yang sangat istimewa. Bagi anak-anak binaan kami, bisa sampai di titik kelulusan adalah pencapaian luar biasa—hasil dari ketekunan belajar di tengah keterbatasan. Mereka hadir mengikuti pelajaran di sela-sela kesibukan membantu orang tua, dengan alat tulis seadanya, bahkan kadang tanpa buku catatan. Namun, semangat mereka tak pernah padam. Di balik toga sederhana yang mereka kenakan, ada harapan besar yang tumbuh pelan-pelan. Wisuda bukan akhir, melainkan awal dari langkah baru menuju masa depan yang lebih baik. Kami ingin menjadikan momen ini lebih bermakna, bukan hanya sebagai seremoni, tapi juga sebagai bentuk dukungan nyata untuk perjalanan pendidikan anak-anak ini ke tahap selanjutnya. Untuk itulah kami membuka kampanye donasi ini—agar kita semua bisa mengambil bagian dalam mendukung kebutuhan pendidikan mereka, mulai dari perlengkapan sekolah, seragam, hingga program pembinaan lanjutan setelah mereka lulus. Donasi Anda, sekecil apa pun, akan sangat berarti bagi mereka. Ini bukan hanya tentang memberi barang, tetapi tentang menguatkan harapan, membuka peluang, dan membuktikan bahwa mereka tidak sendiri. Mari bersama-sama kita rayakan kelulusan mereka dengan memberikan dorongan nyata untuk masa depan yang lebih cerah. Karena setiap anak layak memiliki kesempatan untuk tumbuh dan berhasil, selama ada tangan-tangan yang mau membantu mereka melangkah.",
        "storyImages" => [
            "../assets/images/kampanyedetail/wisuda1.png",
            "../assets/images/kampanyedetail/wisuda2.png",
            "../assets/images/kampanyedetail/wisuda3.png",
        ],
        "uniqueCode" => "456",
        "bankAccount" => [
            "number" => "8991 - 3161 - 91",
            "accountName" => "Sekolah Janji Baik",
            "uniqueCode" => "20",
        ],
    ],
    [
        "id" => "3",
        "image" => "../assets/images/kampanyedetail/agustusan.png",
        "tag" => "Donasi Kampanye Terbatas/Sekilas",
        "title" => "Satu Hari untuk Negeri – Perayaan 17 Agustus di Sekolah Janji Baik",
        "collected" => 3000000,
        "target" => 5000000,
        "daysLeft" => 12,
        "description" => "Hari Kemerdekaan Indonesia selalu menjadi momen penuh makna—bukan hanya untuk mengenang perjuangan para pahlawan, tetapi juga untuk menumbuhkan semangat kebangsaan di hati generasi muda. Di Sekolah Janji Baik, 17 Agustus dirayakan dengan sederhana namun penuh antusiasme. Anak-anak dari keluarga prasejahtera berkumpul bersama, mengikuti upacara, perlombaan, dan kegiatan kreatif lainnya. Di balik senyum dan tawa mereka, ada rasa bangga menjadi bagian dari negeri ini, meski dalam keterbatasan. Tahun ini, kami ingin menjadikan perayaan kemerdekaan sebagai momentum untuk berbagi. Melalui kampanye \"Satu Hari untuk Negeri\", kami mengajak Anda ikut serta mendukung kebutuhan anak-anak Sekolah Janji Baik. Donasi yang Anda berikan akan digunakan untuk menyediakan perlengkapan sekolah, alat lomba, konsumsi kegiatan, serta hadiah simbolis yang membangkitkan semangat mereka. Karena kami percaya, kemerdekaan sejati adalah ketika setiap anak memiliki kesempatan untuk tumbuh dan belajar tanpa batas.Mari rayakan Hari Kemerdekaan bersama anak-anak hebat ini. Satu donasi Anda hari ini bisa menjadi langkah besar bagi mereka untuk terus melangkah ke masa depan. Bersama, kita wujudkan semangat merah putih bukan hanya dalam upacara, tetapi dalam tindakan nyata. Satu hari untuk negeri—satu harapan untuk mereka.",
        "storyImages" => [
            "../assets/images/kampanyedetail/agustusan1.png",
            "../assets/images/kampanyedetail/agustusan2.png",
            "../assets/images/kampanyedetail/agustusan3.png",
        ],
        "uniqueCode" => "789",
        "bankAccount" => [
            "number" => "8991 - 3161 - 91",
            "accountName" => "Perayaan Sekolah Janji Baik",
            "uniqueCode" => "30",
        ],
    ],
    [
        "id" => "4",
        "image" => "../assets/images/kampanyedetail/anaknegeri.png",
        "tag" => "Donasi Kampanye Tetap",
        "title" => "Bekal Belajar untuk Anak Negeri – Donasi Alat Tulis",
        "collected" => 500000,
        "target" => 5000000,
        "daysLeft" => 30,
        "description" => "Setiap anak di negeri ini berhak mendapatkan pendidikan yang layak, termasuk perlengkapan dasar untuk belajar. Namun di Sekolah Janji Baik, banyak anak datang dengan perlengkapan seadanya—tanpa buku catatan, pensil yang sudah patah, atau bahkan harus berbagi satu penghapus untuk beberapa orang. Bukan karena mereka kurang semangat, tetapi karena keterbatasan ekonomi yang membuat hal-hal sederhana seperti alat tulis menjadi barang mewah. Melalui kampanye “Bekal Belajar untuk Anak Negeri”, kami mengajak Anda untuk membantu memenuhi kebutuhan alat tulis anak-anak di Sekolah Janji Baik. Donasi Anda akan digunakan untuk menyediakan buku tulis, pensil, pulpen, penggaris, tempat pensil, hingga alat gambar sederhana. Perlengkapan ini bukan hanya barang, tapi menjadi bekal untuk mereka menulis masa depan, menggambar mimpi, dan belajar dengan lebih percaya diri. Sekecil apa pun donasi Anda, akan menjadi bagian dari perubahan besar dalam kehidupan mereka. Mari bersama kita lengkapi semangat mereka dengan alat belajar yang layak. Karena bekal belajar hari ini adalah pondasi masa depan anak-anak negeri ini. Bantu mereka belajar, bantu mereka tumbuh.",
        "storyImages" => [
            "../assets/images/kampanyedetail/anaknegeri1.png",
            "../assets/images/kampanyedetail/anaknegeri2.png",
            "../assets/images/kampanyedetail/anaknegeri3.png",
        ],
        "uniqueCode" => "321",
        "bankAccount" => [
            "number" => "5566778899",
            "accountName" => "Donasi Pendidikan Janji Baik",
            "uniqueCode" => "40",
        ],
    ],
];

$id = $_GET['id'] ?? null;
$campaign = null;

foreach ($campaigns as $c) {
    if ($c['id'] === $id) {
        $campaign = $c;
        break;
    }
}

if (!$campaign) {
    echo '<p>Kampanye tidak ditemukan.</p>';
    exit;
}
?>

<div class="flex justify-center">
  <div class="w-full max-w-4xl p-6 space-y-6">
    <div class="text-center">
      <img src="<?= $campaign['image'] ?>" alt="<?= $campaign['title'] ?>" class="w-full h-[411px] object-cover rounded-[30px] shadow-md" />
      <h1 class="text-2xl font-bold mb-4 mt-6 text-left"><?= $campaign['title'] ?></h1>
      <div class="text-[#01B4BB] font-bold mt-2 text-left">
        Rp<?= number_format($campaign['collected'], 0, ',', '.') ?>
        <span class="text-gray-600 font-normal">
          dari Rp<?= number_format($campaign['target'], 0, ',', '.') ?>
        </span>
      </div>
      <div class="w-full bg-gray-200 h-2 rounded mt-4">
        <div class="bg-[#01B4BB] h-2 rounded" style="width: <?= min(($campaign['collected'] / $campaign['target']) * 100, 100) ?>%"></div>
      </div>
      <p class="text-sm text-gray-600 mt-1 text-right"><?= $campaign['daysLeft'] ?> Hari</p>
    </div>

    <div>
      <h2 class="text-xl font-semibold mb-6 text-left">Cerita</h2>
      <?php if (count($campaign['storyImages']) > 0): ?>
        <div class="flex flex-wrap justify-center gap-4 mb-8">
          <?php foreach ($campaign['storyImages'] as $img): ?>
            <img src="<?= $img ?>" alt="Cerita" class="w-1/4 rounded shadow" />
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <p class="text-gray-800 leading-relaxed tracking-wide indent-8 whitespace-pre-line text-justify">
        <?= nl2br($campaign['description']) ?>
      </p>
    </div>

    <div>
      <h2 class="text-base font-semibold mb-4 text-left">Cara Berdonasi</h2>
      <div class="bg-white rounded-xl shadow-md p-6">
        <p class="mb-4 font-bold">Donasi dapat ditransferkan melalui :</p>
        <div class="flex items-start space-x-4">
          <img src="../assets/images/logoBCA.png" alt="BCA" class="w-24 h-auto" />
          <div class="text-left mb-4">
            <p class="font-semibold mt-4"><?= $campaign['bankAccount']['number'] ?></p>
            <p class="mt-1 font-bold">a.n <?= $campaign['bankAccount']['accountName'] ?></p>
            <p class="mt-2 font-semibold text-orange-500 text-[22px]">
              Kode Unik : "<?= $campaign['bankAccount']['uniqueCode'] ?>"
            </p>
            <p class="mt-4 text-sm font-bold">Tambahkan kode unik di akhir nominal donasi</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center items-center gap-4 mt-18">
      <a href="kampanye.php" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#EC901D] hover:bg-orange-600 text-white shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </a>

      <a href="../donasi/donasiumum.php" class="flex items-center justify-center bg-[#EC901D] hover:bg-orange-600 text-white py-3 px-8 rounded-full shadow text-sm md:text-base">
        Donasi Sekarang Yuk!
      </a>
    </div>
  </div>
</div>
<?php include '../components/footer.php' ?>