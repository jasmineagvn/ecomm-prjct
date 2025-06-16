<?php
$conn = new mysqli("localhost", "root", "", "janjibaik_db");

// Pagination
$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Total data & total halaman
$total_result = $conn->query("SELECT COUNT(*) AS total FROM galeri");
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Ambil data sesuai halaman
$result = $conn->query("SELECT * FROM galeri ORDER BY created_at ASC LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Galeri</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php include '../components/header.php'; ?>
<body>

  <!-- Start : Hero -->
  <div class="hero relative w-full">
    <img src="../assets/images/bg-galeri.png" alt="">
    <div class="absolute inset-0 px-4 md:px-0 flex flex-col gap-5 items-center mx-auto justify-center w-full md:w-[827px]">
      <h1 class="text-4xl md:text-[50px] font-bold tracking-[-0.7px] text-center text-white">
        Galeri Kebaikan Janji Baik
      </h1>
      <p class="text-sm md:text-base text-white text-center w-full md:w-[700px]">
        Setiap gambar memiliki cerita. Inilah momen-momen penuh makna yang telah kami jalani bersama, mewujudkan janji untuk kebaikan. Mari terus berbagi dan menginspirasi!
      </p>
    </div>
  </div>
  <!-- End : Hero -->

  <div class="pl-16 mx-auto mt-20 flex items-center justify-between">
    <h1 class="text-[30px] font-semibold">Jejak Kebaikan dalam Setiap Momen</h1>
    <img src="/janji-baik/assets/images/garis.png" alt="" class="w-[750px]">
  </div>

  <div class="flex max-w-6xl mx-auto mt-[67px] flex-wrap justify-center gap-16">
    <?php while ($row = $result->fetch_assoc()): ?>
      <a href="detail.php?id=<?= $row['id'] ?>" class="w-[320px] py-4 px-5 bg-white gap-6 flex flex-col items-center justify-center rounded shadow cursor-pointer">
        <img src="../uploads/galeri/<?= $row['thumbnail'] ?>" alt="Thumbnail" class="w-full h-[300px] object-cover">
        <div class="flex w-full justify-between items-center">
          <p class="text-sm text-gray-600 font-bold"><?= htmlspecialchars($row['judul']) ?></p>
          <img src="/janji-baik/assets/images/arrow_galeri.png" alt="" class="w-10">
        </div>
      </a>
    <?php endwhile; ?>
  </div>

  <!-- Pagination mirip tombol di React -->
<div class="flex justify-center mt-12 space-x-4">
  <!-- Tombol Prev -->
  <a
    href="?page=<?= max(1, $page - 1) ?>"
    class="px-3 py-1 rounded bg-gray-200 <?= $page == 1 ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-300' ?>"
  >
    Prev
  </a>

  <!-- Nomor Halaman -->
  <?php for ($i = 1; $i <= $total_pages; $i++): ?>
    <a
      href="?page=<?= $i ?>"
      class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>"
    >
      <?= $i ?>
    </a>
  <?php endfor; ?>

  <!-- Tombol Next -->
  <a
    href="?page=<?= min($total_pages, $page + 1) ?>"
    class="px-3 py-1 rounded bg-gray-200 <?= $page == $total_pages ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-300' ?>"
  >
    Next
  </a>
</div>


<?php include '../components/footer.php'; ?>
</body>
</html>
