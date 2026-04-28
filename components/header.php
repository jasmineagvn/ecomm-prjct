<?php
// START SESSION
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// BASE URL
$base_url = "/ecomm-prjct/";

// ACTIVE NAV
$currentPage = basename($_SERVER['PHP_SELF']);

function active($page) {
  global $currentPage;
  return $currentPage == $page
    ? 'text-[#D9A86C] font-medium'
    : 'text-[#2D2D2D] font-medium hover:text-[#D9A86C] transition';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= $base_url ?>assets/logo.svg">

  <title>Domio</title>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind -->
  <link href="<?= $base_url ?>assets/css/tailwind.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { font-family: 'Manrope', sans-serif; }
  </style>
</head>

<body>

<header class="bg-white">
  <div class="max-w-6xl mx-auto flex px-4 md:px-0 justify-between items-center py-3">

    <!-- LOGO -->
    <a href="<?= $base_url ?>index.php">
      <img src="<?= $base_url ?>assets/logo.svg" class="w-[98px]">
    </a>

    <!-- NAV -->
    <nav class="flex gap-10 items-center">
      <a href="<?= $base_url ?>index.php" class="<?= active('index.php') ?>">Home</a>
      <a href="<?= $base_url ?>shop.php" class="<?= active('shop.php') ?>">Shop</a>
      <a href="<?= $base_url ?>categories.php" class="<?= active('categories.php') ?>">Categories</a>
      <a href="<?= $base_url ?>about.php" class="<?= active('about.php') ?>">About</a>
    </nav>

    <!-- ICON -->
    <div class="flex items-center gap-4">

      <!-- 🔍 SEARCH -->
      <div class="relative">

        <!-- BUTTON -->
        <button id="searchBtn"
          class="w-10 h-10 rounded-full bg-[#F7E9D7] flex items-center justify-center hover:scale-110 transition">
          <img src="<?= $base_url ?>assets/icons/search.svg" class="w-5 h-5">
        </button>

        <!-- INPUT BOX -->
        <form 
          action="<?= $base_url ?>shop.php" 
          method="GET"
          id="searchBox"
          class="absolute right-0 mt-3 bg-white shadow-lg rounded-full px-4 py-2 flex items-center gap-2 w-64 opacity-0 invisible translate-y-2 transition-all duration-200 z-50 border border-black"
        >

          <input 
            type="text" 
            name="search"
            placeholder="Search..."
            class="w-full outline-none text-sm"
          >

          <button type="submit"></button>

        </form>

      </div>

      <!-- 🛒 CART -->
      <a href="<?= $base_url ?>cart.php"
        class="w-10 h-10 rounded-full bg-[#F7E9D7] flex items-center justify-center hover:scale-110 transition">
        <img src="<?= $base_url ?>assets/icons/cart.svg" class="w-5 h-5">
      </a>

      <!-- 👤 USER -->
      <a href="<?= $base_url . (isset($_SESSION['user']) ? 'dashboard.php' : 'login.php'); ?>"
        class="w-10 h-10 rounded-full bg-[#F7E9D7] flex items-center justify-center hover:scale-110 transition">
        <img src="<?= $base_url ?>assets/icons/user.svg" class="w-5 h-5">
      </a>

    </div>

  </div>
</header>

<!-- 🔥 SCRIPT SEARCH -->
<script>
const searchBtn = document.getElementById('searchBtn');
const searchBox = document.getElementById('searchBox');
const input = searchBox.querySelector('input');

// toggle buka/tutup
searchBtn.addEventListener('click', (e) => {
  e.stopPropagation();

  searchBox.classList.toggle('opacity-0');
  searchBox.classList.toggle('invisible');
  searchBox.classList.toggle('translate-y-2');

  setTimeout(() => input.focus(), 100);
});

// klik luar → tutup
document.addEventListener('click', (e) => {
  if (!searchBox.contains(e.target) && !searchBtn.contains(e.target)) {
    searchBox.classList.add('opacity-0', 'invisible', 'translate-y-2');
  }
});
</script>