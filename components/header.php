<?php
// START SESSION
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// TOTAL CART
$count = 0;

if (isset($_SESSION['user_id'])) {

  require_once __DIR__ . '/../config/database.php';

  $database = new Database();
  $db = $database->getConnection();

  $query = "
        SELECT SUM(quantity) AS total
        FROM cart
        WHERE user_id = ?
    ";

  $stmt = $db->prepare($query);
  $stmt->execute([
    $_SESSION['user_id']
  ]);

  $cartData = $stmt->fetch(PDO::FETCH_ASSOC);

  $count = $cartData['total'] ?? 0;
}

// BASE URL
$base_url = "/ecomm-prjct/";

// ACTIVE NAV
$currentPage = basename($_SERVER['PHP_SELF']);

function active($page)
{
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
  <link rel="icon" href="<?= $base_url ?>assets/images/logo/logo.svg">

  <title>Domio</title>

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

  <header class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-2 flex items-center">

      <!-- LOGO -->
      <div class="w-1/3">

        <a href="<?= $base_url ?>index.php">

          <img
            src="<?= $base_url ?>assets/images/logo/logo.svg"
            class="w-[90px]">

        </a>

      </div>

      <!-- NAVIGATION -->
      <div class="w-1/3 flex justify-center">

        <nav class="flex gap-10 items-center">

          <a href="<?= $base_url ?>index.php"
            class="<?= active('index.php') ?>">
            Home
          </a>

          <a href="<?= $base_url ?>shop.php"
            class="<?= active('shop.php') ?>">
            Shop
          </a>

          <a href="<?= $base_url ?>categories.php"
            class="<?= active('categories.php') ?>">
            Categories
          </a>

          <a href="<?= $base_url ?>about.php"
            class="<?= active('about.php') ?>">
            About
          </a>

        </nav>

      </div>

      <!-- ACTIONS -->
      <div class="w-1/3 flex justify-end items-center gap-4">

        <!-- SEARCH -->
        <form
          action="<?= $base_url ?>shop.php"
          method="GET"
          class="hidden lg:flex items-center
                bg-[#F7E9D7]
                border border-[#F7E9D7]
                rounded-full
                px-4 py-2
                w-56">

          <img
            src="<?= $base_url ?>assets/icons/search.svg"
            class="w-4 h-4">

          <input
            type="text"
            name="search"
            placeholder="Search furniture..."
            class="ml-3 w-full bg-transparent
                outline-none text-sm
                text-[#543A14]
                placeholder:text-[#8B7355]">

        </form>

        <!-- CART -->
        <a href="<?= $base_url ?>cart.php"
          class="relative w-10 h-10 rounded-full bg-[#F7E9D7]
                flex items-center justify-center
                hover:scale-110 transition">

          <img
            src="<?= $base_url ?>assets/icons/cart.svg"
            class="w-5 h-5">

          <?php if ($count > 0): ?>

            <span
              class="absolute -top-1 -right-1
                    bg-black text-white
                    text-[10px]
                    w-5 h-5 rounded-full
                    flex items-center justify-center">

              <?= $count ?>

            </span>

          <?php endif; ?>

        </a>

        <!-- USER -->
        <?php if (isset($_SESSION['username'])): ?>

          <div class="relative">

            <button
              id="userMenuButton"
              class="flex items-center gap-3
                    bg-[#F7E9D7]
                    px-4 py-2
                    rounded-full
                    hover:bg-[#EED6B5]
                    transition">

              <img
                src="<?= $base_url ?>assets/icons/user.svg"
                class="w-5 h-5">

              <span
                class="text-sm font-medium text-[#1E1E1E]">

                <?= htmlspecialchars($_SESSION['username']) ?>

              </span>

            </button>

            <!-- DROPDOWN -->
            <div
              id="userDropdown"
              class="hidden absolute right-0 mt-3 w-56
                    bg-white rounded-2xl shadow-lg
                    border border-[#F2F2F2]
                    overflow-hidden z-50">

              <div class="px-5 py-4 bg-[#FAFAFA]">

                <p class="font-medium">

                  <?= htmlspecialchars($_SESSION['username']) ?>

                </p>

                <p class="text-xs text-gray-500">

                  <?= htmlspecialchars($_SESSION['email']) ?>

                </p>

              </div>

              <a
                href="<?= $base_url ?>profile.php"
                class="block px-5 py-3
                      hover:bg-[#FFF8F0]
                      hover:text-[#543A14]
                      transition">

                My Profile

              </a>

              <a
                href="<?= $base_url ?>orders.php"
                class="block px-5 py-3
                      hover:bg-[#FFF8F0]
                      hover:text-[#543A14]
                      transition">

                My Orders

              </a>

              <button
                onclick="openLogoutModal()"
                class="block w-full text-left px-5 py-3 text-red-500 hover:bg-red-50 transition">

                Logout

              </button>

            </div>

          </div>

        <?php else: ?>

          <a
            href="<?= $base_url ?>login.php"
            class="w-10 h-10 rounded-full
                    bg-[#F7E9D7]
                    flex items-center justify-center
                    hover:scale-110 transition">

            <img
              src="<?= $base_url ?>assets/icons/user.svg"
              class="w-5 h-5">

          </a>

        <?php endif; ?>

      </div>

    </div>

    <!-- LOGOUT MODAL -->
    <div
      id="logoutModal"
      class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

      <div
        class="bg-white w-[420px] rounded-3xl p-8 shadow-2xl text-center">

        <h2 class="text-2xl font-semibold text-[#1E1E1E] mb-3">

          Logout Account

        </h2>

        <p class="text-gray-500 mb-8">

          Are you sure you want to logout from your account?

        </p>

        <div class="flex justify-center gap-3">

          <!-- CANCEL -->
          <button
            onclick="closeLogoutModal()"
            class="px-6 py-3
                        border border-[#D6CFC7]
                        rounded-full
                        hover:bg-gray-100
                        transition">

            Cancel

          </button>

          <!-- LOGOUT -->
          <a
            href="<?= $base_url ?>logout.php"
            class="bg-black text-white
                        px-8 py-3
                        rounded-full
                        hover:bg-[#FFF0DC]
                        hover:text-[#543A14]
                        transition-all duration-300">

            Logout

          </a>

        </div>

      </div>

    </div>
  </header>

  <!-- SCRIPT DROPDOWN -->
  <script>
    const userButton =
      document.getElementById('userMenuButton');

    const dropdown =
      document.getElementById('userDropdown');

    if (userButton && dropdown) {

      userButton.addEventListener('click', function(e) {

        e.stopPropagation();

        dropdown.classList.toggle('hidden');

      });

      document.addEventListener('click', function(e) {

        if (
          !userButton.contains(e.target) &&
          !dropdown.contains(e.target)
        ) {

          dropdown.classList.add('hidden');

        }

      });

    }
  </script>

  <!-- SCRIPT SEARCH -->
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

  <!-- SCRIPT LOGOUT -->
  <script>
    function openLogoutModal() {

      document
        .getElementById('logoutModal')
        .classList
        .remove('hidden');

      document
        .getElementById('logoutModal')
        .classList
        .add('flex');
    }

    function closeLogoutModal() {

      document
        .getElementById('logoutModal')
        .classList
        .add('hidden');

      document
        .getElementById('logoutModal')
        .classList
        .remove('flex');
    }
  </script>