<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Kolaborasi</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<?php include '../components/header.php'; ?>

<body class="bg-gray-100">

    <!-- Start : Hero -->
    <div class="hero relative">
        <img src="../assets/images/bg-berkolaborasi.png" alt="" class="w-full">
        <div class="absolute inset-0 px-4 md:px-0 flex flex-col gap-5 items-center mx-auto justify-center w-full md:w-[827px]">
            <h1 class="text-4xl md:text-[50px] font-bold tracking-[-0.7px] text-center text-white">
                Ayo Berkolaborasi
            </h1>
            <p class="text-sm md:text-base text-white text-center w-full md:w-[700px]">
                Jika Anda tertarik untuk berkolaborasi, Janji Baik siap menyambut ide-ide baru dan kesempatan untuk bekerja bersama. Kami percaya bahwa kolaborasi yang erat akan membawa dampak positif yang lebih besar. Hubungi kami untuk memulai kerja sama yang bermakna dan mewujudkan perubahan bersama.
            </p>
        </div>
    </div>
    <!-- End : Hero -->

    <!-- Start: Swiper Card Kolaborasi -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                $cards = [
                    [
                        "image" => "../assets/images/kolaborasi/card1.jpg",
                        "title" => "Pertamina",
                        "text"  => "Pertamina"
                    ],
                    [
                        "image" => "../assets/images/kolaborasi/card2.png",
                        "title" => "Universitas Indonesia",
                        "text"  => "Penandatanganan Kerjasama Janji Baik dengan Kesejahteraan Sosial Universitas Indonesia"
                    ],
                    [
                        "image" => "../assets/images/kolaborasi/card3.png",
                        "title" => "KitaBisa",
                        "text"  => "Kolaborasi Janji Baik dan Kitabisa.com Hadirkan Dukungan Bermakna bagi Siswa Difabel lewat Program Lingkar Kasih"
                    ],
                    [
                        "image" => "../assets/images/kolaborasi/card4.png",
                        "title" => "Bakrie Center Foundation",
                        "text"  => "Pemberian Penghargaan The Most Innovative Program of Practical Program dari BCF kepada Janji Baik"
                    ],
                ];

                foreach ($cards as $card) {
                    echo '
                    <div class="swiper-slide">
                        <div class="bg-white shadow-md rounded-[12px] overflow-hidden">
                            <img src="' . $card["image"] . '" alt="' . $card["title"] . '" class="w-full h-48 object-cover">
                            <div class="p-4 text-sm font-bold text-gray-800 leading-snug">' . $card["title"] . '</div>
                            <div class="px-4 pb-4 text-sm text-gray-800 leading-snug">' . $card["text"] . '</div>
                        </div>
                    </div>';
                }
                ?>
            </div>

            <!-- Navigasi -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <!-- End: Swiper Card Kolaborasi -->

    <!-- Start: Form Kolaborasi -->
    <div class="min-h-screen px-6 py-12 flex items-center justify-center">
    <div class="w-full max-w-5xl bg-[#E7F6F7] p-5 md:p-14 lg:p-20 rounded-3xl shadow-xl">
        <h2 class="text-3xl font-bold text-center mb-2 text-gray-900">Form Berkolaborasi</h2>
        <p class="text-center text-sm text-gray-700 mb-10">
        Isi formulir di bawah ini, dan tim kami akan segera menghubungi Anda untuk membahas peluang<br />
        kolaborasi lebih lanjut.
        </p>

        <form action="../process/kolaborasi_process.php" method="POST" class="space-y-6">
        <div>
            <label class="block mb-2 text-sm font-medium text-[#72717B]">
            Alamat Email <span class="text-red-500">*</span>
            </label>
            <input
            type="email"
            name="email"
            placeholder="Ketik Email"
            class="bg-white w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
            required
            />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[#72717B]">
            Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <input
            type="text"
            name="nama_lengkap"
            placeholder="Ketik Nama Lengkap"
            class="bg-white w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
            required
            />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[#72717B]">
            Nama Lembaga/Komunitas <span class="text-red-500">*</span>
            </label>
            <input
            type="text"
            name="nama_lembaga"
            placeholder="Ketik Nama Lembaga/Komunitas"
            class="bg-white w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
            required
            />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[#72717B]">
            No. HP / WhatsApp <span class="text-red-500">*</span>
            </label>
            <input
            type="tel"
            name="no_hp"
            placeholder="Ketik No. HP / WhatsApp"
            class="bg-white w-full md:w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
            required
            />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[#72717B]">
            Jenis Kolaborasi yang Diinginkan <span class="text-red-500">*</span>
            </label>
            <input
            type="text"
            name="jenis_kolaborasi"
            placeholder="Ketik Jenis Kolaborasi"
            class="bg-white w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
            required
            />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[#72717B]">
            Deskripsi Kolaborasi
            </label>
            <input
            type="text"
            name="deskripsi"
            placeholder="Ketik Deskripsi Kolaborasi"
            class="bg-white w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
            />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[#72717B]">
            Pesan Tambahan/Pertanyaan <span class="text-red-500">*</span>
            </label>
            <textarea
            name="pesan"
            rows="4"
            placeholder="Ketik Pesan"
            class="bg-white w-full h-[194px] px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
            required
            ></textarea>
        </div>

        <div class="flex justify-end pt-4">
            <button
            type="submit"
            class="bg-[#EC901D] hover:bg-orange-600 text-white px-6 py-2 rounded-full w-[127px] cursor-pointer"
            >
            Kirim
            </button>
        </div>
        </form>
    </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <!-- End: Form Kolaborasi -->


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.mySwiper', {
                loop: true,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });
        });
    </script>

    <!-- Tambahkan jQuery & Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?php if (isset($_SESSION['success_message'])): ?>
    <script>
        $(document).ready(function () {
            toastr.success("<?= $_SESSION['success_message']; ?>", "Isi Form Berhasil!", {
                positionClass: "toast-top-right",
                timeOut: 3000,
                closeButton: true,
                progressBar: true
            });
        });
    </script>
    <?php unset($_SESSION['success_message']); endif; ?>
</body>
</html>
