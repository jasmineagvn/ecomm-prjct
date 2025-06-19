<!-- <?php
// Deteksi level folder
$level = (strpos($_SERVER['REQUEST_URI'], '/forms/') !== false) ? '../' : '';
?> -->

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="/janji-baik/assets/logo.png">
  <title>Janji Baik</title>
  <!-- <link rel="stylesheet" href="<?php echo $level; ?>assets/css/tailwind.css"> -->
   
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="/assets/css/tailwind.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  
  
  <!-- Fallback CSS untuk memastikan font Manrope -->
  <style>
    .font-manrope {
      font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
    }
  </style>
</head>
<body class="font-manrope">
  <header class="bg-white">
    <div class="max-w-6xl mx-auto flex px-4 md:px-0 justify-between items-center my-2">
      <img src="/janji-baik/assets/images/logo.png" alt="Logo" class="w-[98px]">

      <nav class="flex gap-10 items-center relative">
        <a href="/janji-baik/index.php" class="text-gray-500 hover:text-[#5EC2C2] transition-colors duration-200">Beranda</a>

        <!-- Tentang Kami Dropdown -->
        <div class="relative">
          <div class="flex items-center">
            <a href="/janji-baik/about.php" class="text-gray-500 hover:text-[#5EC2C2] transition-colors duration-200">
              Tentang Kami
            </a>
            <button class="ml-2 p-1 rounded-full hover:bg-gray-100 transition-colors duration-200" 
                    id="tentangKamiBtn">
              <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" 
                   id="tentangKamiArrow"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
          </div>
          
          <!-- Dropdown Menu dengan animasi -->
          <div class="absolute mt-2 bg-white shadow-lg rounded-[12px] p-2 space-y-2 z-50 w-40 
opacity-0 invisible translate-y-2 transition-all duration-200" 
               id="tentangKamiDropdown">
            <div class="py-2">
              <a href="/janji-baik/jbonnews.php" 
                 class="block px-3 py-2 mb-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                <!-- <svg class="w-4 h-4 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg> -->
                JB On News
              </a>
              <a href="/janji-baik/galeri/index.php" 
                 class="block px-3 py-2 mb-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                <!-- <svg class="w-4 h-4 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg> -->
                Galeri
              </a>
              <a href="/janji-baik/jbteam.php" 
                 class="block px-3 py-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                <!-- <svg class="w-4 h-4 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg> -->
                Team
              </a>
            </div>
          </div>
        </div>

        <!-- Daftar Dropdown -->
        <div class="relative">
          <div class="flex items-center">
            <span class="text-gray-500">Daftar</span>
            <button class="ml-2 p-1 rounded-full hover:bg-gray-100 transition-colors duration-200" 
                    id="daftarBtn">
              <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" 
                   id="daftarArrow"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
          </div>
          
          <div class="absolute mt-2 bg-white shadow-lg rounded-[12px] p-2 space-y-2 z-50 w-40 
opacity-0 invisible translate-y-2 transition-all duration-200" 
               id="daftarDropdown">
            <div class="py-2">
                <a href="/janji-baik/forms/syarat_siswa.php" 
                  class="block px-3 py-2 mb-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                  Daftar Siswa
                </a>

                <a href="/janji-baik/forms/daftar_relawan.php" 
                  class="block px-3 py-2 mb-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                  Daftar Relawan
                </a>

                <a href="/janji-baik/forms/kolaborasi_form.php" 
                  class="block px-3 py-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                  Berkolaborasi
                </a>
              </div>

          </div>
        </div>

        <a href="/janji-baik/jbprogram.php" class="text-gray-500 hover:text-[#5EC2C2] transition-colors duration-200">Program</a>

        <!-- Donasi Dropdown -->
        <div class="relative">
          <div class="flex items-center">
            <span class="text-gray-500">Donasi</span>
            <button class="ml-2 p-1 rounded-full hover:bg-gray-100 transition-colors duration-200" 
                    id="donasiBtn">
              <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" 
                   id="donasiArrow"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
          </div>
          
          <div class="absolute mt-2 bg-white shadow-lg rounded-[12px] p-2 space-y-2 z-50 w-40 
opacity-0 invisible translate-y-2 transition-all duration-200" 
               id="donasiDropdown">
            <div class="py-2">
              <a href="/janji-baik/donasi/berkalabaik.php" 
                 class="block px-3 py-2 mb-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                <!-- <svg class="w-4 h-4 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg> -->
                Berkala Baik
              </a>
              <a href="/janji-baik/donasi/donasiumum.php" 
                 class="block px-3 py-2 mb-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                <!-- <svg class="w-4 h-4 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg> -->
                Donasi Umum
              </a>
              <a href="/janji-baik/kampanye/kampanye.php" 
                 class="block px-3 py-2 hover:bg-[#5EC2C2] text-gray-500 hover:text-white rounded-[12px]">
                <!-- <svg class="w-4 h-4 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M10.5 3L12 6l1.5-3h-3z"></path>
                </svg> -->
                Kampanye
              </a>
            </div>
          </div>
        </div>

        <a href="/janji-baik/jbkontak.php" class="text-gray-500 hover:text-[#5EC2C2] transition-colors duration-200">Kontak Kami</a>

        <?php
          $current_page = basename($_SERVER['PHP_SELF']);
          if ($current_page == 'index.php'):
          ?>
            <a href="/janji-baik/admin/dashboard.php" class="flex items-center gap-2 text-white bg-[#5EC2C2] hover:bg-yellow-400 px-4 py-2 rounded-[12px] transition-colors duration-200">
              <img src="./assets/images/user-shield-solid.svg" alt="Admin Icon" class="w-5 h-5">Admin
            </a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <!-- Script untuk dropdown functionality -->
  <script>
    // Fungsi untuk toggle dropdown
    function toggleDropdown(buttonId, dropdownId, arrowId) {
      const button = document.getElementById(buttonId);
      const dropdown = document.getElementById(dropdownId);
      const arrow = document.getElementById(arrowId);
      
      button.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Tutup semua dropdown lain
        closeAllDropdowns();
        
        // Toggle dropdown yang diklik
        const isVisible = !dropdown.classList.contains('opacity-0');
        
        if (isVisible) {
          // Tutup dropdown
          dropdown.classList.add('opacity-0', 'invisible', 'translate-y-2');
          dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
          arrow.classList.remove('rotate-180');
        } else {
          // Buka dropdown
          dropdown.classList.remove('opacity-0', 'invisible', 'translate-y-2');
          dropdown.classList.add('opacity-100', 'visible', 'translate-y-0');
          arrow.classList.add('rotate-180');
        }
      });
    }
    
    // Fungsi untuk menutup semua dropdown
    function closeAllDropdowns() {
      const dropdowns = ['tentangKamiDropdown', 'daftarDropdown', 'donasiDropdown'];
      const arrows = ['tentangKamiArrow', 'daftarArrow', 'donasiArrow'];
      
      dropdowns.forEach((dropdownId, index) => {
        const dropdown = document.getElementById(dropdownId);
        const arrow = document.getElementById(arrows[index]);
        
        dropdown.classList.add('opacity-0', 'invisible', 'translate-y-2');
        dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
        arrow.classList.remove('rotate-180');
      });
    }
    
    // Inisialisasi dropdown
    document.addEventListener('DOMContentLoaded', function() {
      toggleDropdown('tentangKamiBtn', 'tentangKamiDropdown', 'tentangKamiArrow');
      toggleDropdown('daftarBtn', 'daftarDropdown', 'daftarArrow');
      toggleDropdown('donasiBtn', 'donasiDropdown', 'donasiArrow');
      
      // Tutup dropdown saat klik di luar
      document.addEventListener('click', function(e) {
        const isClickInsideDropdown = e.target.closest('.relative');
        if (!isClickInsideDropdown) {
          closeAllDropdowns();
        }
      });
    });
  </script>

</body>
</html>