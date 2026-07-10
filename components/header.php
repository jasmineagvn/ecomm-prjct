<?php
// START SESSION
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// BASE URL
$base_url = "/sistem-prediksi/";

// ACTIVE NAV
$currentPage = basename($_SERVER['PHP_SELF']);

function active($page)
{
    global $currentPage;

    return $currentPage == $page
        ? 'text-[#875988] font-semibold'
        : 'text-[#00204A] font-medium hover:text-[#875988] transition duration-300';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= $base_url ?>assets/images/logo/logo.svg">

  <title>Lavender Prediction System</title>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind -->
  <link href="<?= $base_url ?>assets/css/tailwind.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Manrope', sans-serif;
    }
  </style>
</head>

<body>
    <div class="max-w-7xl mx-auto px-8 h-20 flex items-center justify-between">

        <!-- Logo -->
        <a href="<?= $base_url ?>index.php" class="flex items-center gap-3">

          <img
          src="assets/images/logo/logo.png"
          class="w-10 h-10">
            <span class="text-[23px] font-bold text-[#00204A]">
                Posyandu Lavender
            </span>
        </a>

        <!-- Navbar -->
        <nav class="flex items-center gap-8">

    <!-- Beranda selalu tampil -->
    <a href="<?= $base_url ?>index.php"
        class="<?= active('index.php') ?>">
        Beranda
    </a>

    <?php if ($currentPage != 'hasil.php'): ?>

        <!-- Cek Prediksi -->
        <a href="<?= $base_url ?>prediksi.php"
            class="<?= active('prediksi.php') ?>">
            Cek Prediksi
        </a>

        <!-- Button Analisis -->
        <a href="<?= $base_url ?>prediksi.php"
            class="bg-[#875988]
                   hover:bg-[#744A75]
                   text-white
                   rounded-full
                   px-6
                   py-3
                   flex
                   items-center
                   gap-3
                   transition">

            Mulai Analisis Sekarang

            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"/>

                </svg>

            </div>

        </a>

    <?php endif; ?>

</nav>

    </div>
  </header>