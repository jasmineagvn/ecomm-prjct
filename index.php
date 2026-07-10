<?php

session_start();

include 'components/header.php';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.6.2/countUp.umd.js"></script>

  <!-- Start : Hero -->
<section class="bg-white pt-16 pb-24">
    <div class="max-w-7xl mx-auto px-8">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Left Content -->
            <div>

                <h1 class="font-bold
           text-[50px]
           text-[#1F1F1F]
           leading-[56px]
           tracking-[-0.7px]
           w-[700px]">

                    Pantau Kehadiran,<br>
                    Pastikan Tumbuh Kembang<br>
                    Buah Hati Terjaga.

                </h1>

                <p class="mt-8 text-[#555555] text[16px] font-medium leading-8 max-w-xl">

                    Gunakan sistem prediksi untuk melihat estimasi tingkat
                    kunjungan di Posyandu Lavender. Masukkan data pendukung
                    untuk mendapatkan hasil analisis yang membantu
                    mengoptimalkan pelayanan kesehatan bagi buah hati.

                </p>

                <!-- Button -->
                <a href="prediksi.php"
                    class="inline-flex items-center mt-10">

                    <div
                        class="bg-[#875988]
                               hover:bg-[#734874]
                               text-white
                               rounded-full
                               pl-7
                               pr-5
                               py-4
                               flex
                               items-center
                               gap-5
                               transition">

                        <span class="font-medium">

                            Mulai Cek Prediksi

                        </span>

                        <div
                            class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"/>

                            </svg>

                        </div>

                    </div>

                </a>

            </div>

            <!-- Right Image -->
            <div class="flex justify-end">

                <img
                    src="assets/images/hero/hero-image.png"
                    class="w-[458px] h-[494px] rounded-[35px] object-cover">

            </div>

        </div>

    </div>
</section>
<!-- End : Hero -->

  <!-- Start : Statistics -->
<section class="bg-white pb-24">

    <div class="max-w-7xl mx-auto px-8 mt-20 mb-15">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            <!-- Card 1 -->
            <div
                class="bg-white rounded-[30px] shadow-[0_10px_35px_rgba(0,0,0,0.08)] p-8 h-[185px] flex flex-col justify-between">

                <div class="flex items-center gap-5">

                    <img
                        src="assets/icons/baby.png"
                        alt="Total Balita"
                        class="w-16 h-16">

                    <h3
                        class="text-[18px] font-semibold text-[#1F1F1F]">

                        Total Balita:

                    </h3>

                </div>

                <p
                    class="text-right text-[52px] font-bold text-[#875988]">

                    120

                </p>

            </div>

            <!-- Card 2 -->
            <div
                class="bg-white rounded-[30px] shadow-[0_10px_35px_rgba(0,0,0,0.08)] p-8 h-[185px] flex flex-col justify-between">

                <div class="flex items-center gap-5">

                    <img
                        src="assets/icons/kalender.png"
                        alt="Presentase Kehadiran"
                        class="w-16 h-16">

                    <h3
                        class="text-[18px] font-semibold text-[#1F1F1F]">

                        Presentase Kehadiran:

                    </h3>

                </div>

                <p
                    class="text-right text-[52px] font-bold text-[#875988]">

                    85%

                </p>

            </div>

            <!-- Card 3 -->
            <div
                class="bg-white rounded-[30px] shadow-[0_10px_35px_rgba(0,0,0,0.08)] p-8 h-[185px] flex flex-col justify-between">

                <div class="flex items-center gap-5">

                    <img
                        src="assets/icons/statistik.png"
                        alt="Prediksi Tidak Hadir"
                        class="w-16 h-16">

                    <h3
                        class="text-[18px] font-semibold text-[#1F1F1F]">

                        Prediksi Tidak Hadir:

                    </h3>

                </div>

                <p
                    class="text-right text-[52px] font-bold text-[#875988]">

                    15%

                </p>

            </div>

        </div>

    </div>

</section>
<!-- End : Statistics -->


  <!-- Start : Layanan -->
<section class="bg-[#F2F2F2] pt-16 pb-16 rounded-t-[18px]">

    <div class="max-w-7xl mx-auto px-8">

        <!-- Heading -->
        <h2 class="text-center
                   text-[30px]
                   font-bold
                   text-[#1F1F1F]
                   mb-16">

            Layanan Sistem Prediksi Posyandu

        </h2>

        <!-- Grid -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Card 1 -->
            <div
                class="col-span-12 lg:col-span-7
                       bg-white
                       rounded-[25px]
                       p-10
                       min-h-[230px]
                       flex flex-col justify-between">

                <div>

                    <h3 class="text-[32px] font-bold text-[#1F1F1F] mb-8">

                        Analisis Prediksi Kehadiran

                    </h3>

                    <p class="text-[16px]
                              leading-8
                              text-[#4B4B4B]
                              max-w-[520px]">

                        Pantau dan prediksi tingkat kunjungan ibu dan anak
                        setiap bulannya dengan teknologi analisis data untuk
                        memastikan pelayanan yang lebih siap.

                    </p>

                </div>

            </div>

            <!-- Card 2 -->
            <div
                class="col-span-12 lg:col-span-5
                       bg-white
                       rounded-[25px]
                       p-10
                       min-h-[230px]
                       flex flex-col justify-between">

                <div>

                    <h3 class="text-[32px] font-bold text-[#1F1F1F] mb-8">

                        Data Terpadu

                    </h3>

                    <p class="text-[16px]
                              leading-8
                              text-[#4B4B4B]">

                        Pengelolaan metadata dan profil kesehatan anak
                        secara digital, memudahkan pencarian riwayat
                        kunjungan tanpa tumpukan kertas.

                    </p>

                </div>

            </div>

            <!-- Card 3 -->
            <div
                class="col-span-12 lg:col-span-4
                       bg-white
                       rounded-[25px]
                       p-10
                       min-h-[230px]
                       flex flex-col justify-between">

                <div>

                    <h3 class="text-[32px] font-bold text-[#1F1F1F] mb-8">

                        Pantau<br>
                        Tumbuh Kembang

                    </h3>

                    <p class="text-[16px]
                              leading-8
                              text-[#4B4B4B]">

                        Membantu memantau konsistensi kehadiran yang
                        berdampak langsung pada pemantauan gizi dan
                        perkembangan rutin balita.

                    </p>

                </div>

            </div>

            <!-- Card 4 -->
            <div
                class="col-span-12 lg:col-span-8
                       bg-white
                       rounded-[25px]
                       p-10
                       min-h-[230px]
                       flex flex-col justify-between">

                <div>

                    <h3 class="text-[32px] font-bold text-[#1F1F1F] mb-8">

                        Laporan Digital Otomatis

                    </h3>

                    <p class="text-[16px]
                              leading-8
                              text-[#4B4B4B]
                              max-w-[650px]">

                        Dapatkan ringkasan kriteria hasil prediksi secara
                        otomatis sebagai bahan evaluasi untuk meningkatkan
                        partisipasi masyarakat di Posyandu Lavender.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- End : Layanan -->

</main>
<?php include 'components/footer.php' ?>