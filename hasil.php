<?php
include 'components/header.php';
?>

<section class="py-20 bg-white">

    <div class="max-w-6xl mx-auto px-8">

        <!-- Hero -->
<div class="relative h-[320px] mb-6">

    <!-- Judul -->
    <div class="pt-10 max-w-[450px]">

        <h1 class="text-[60px] font-bold text-[#1F1F1F] leading-none mb-5">
            Berhasil!
        </h1>

        <p class="text-[18px] font-medium leading-8 text-[#444]">

            Input data prediksi berhasil, berikut adalah hasil
            prediksi kehadiran berdasarkan data input yang masuk.

        </p>

    </div>

    <!-- Gambar -->
    <img
        src="assets/icons/ibuanak.png"
        alt="Ibu dan Balita"
        class="absolute
               right-0
               bottom-[-70px]
               w-[600px]
               h-auto
               object-contain
               z-20">

</div>
        <!-- Card -->
        <div
    class="relative
           z-10
           bg-[#F4E4F5]
           rounded-[35px]
           shadow-lg
           px-12
           pt-14
           pb-10
           -mt-4">

            <!-- Heading -->
            <div class="flex items-center gap-4 mb-5">

                <div
                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center">

                    ✓

                </div>

                <h2 class="text-[34px] font-bold">

                    Prediksi Kehadiran Berhasil!

                </h2>

            </div>

            <hr class="border-[#8E8E8E] mb-10">

            <!-- Hasil -->

            <div class="space-y-8">

                <!-- Kategori -->
                <div class="grid grid-cols-3 items-center gap-8">

                    <h3 class="font-semibold text-[22px]">

                        Kategori

                    </h3>

                    <div class="col-span-2">

                        <div
                            class="bg-white rounded-xl h-16 px-6 flex items-center text-[20px]">

                            Partisipasi Baik

                        </div>

                    </div>

                </div>

                <!-- Persentase -->

                <div class="grid grid-cols-3 items-center gap-8">

                    <h3 class="font-semibold text-[22px]">

                        Presentase Prediksi Kehadiran

                    </h3>

                    <div class="col-span-2">

                        <div
                            class="bg-white rounded-xl h-16 px-6 flex items-center text-[20px] font-semibold text-[#875988]">

                            85%

                        </div>

                    </div>

                </div>

                <!-- Saran -->

                <div class="grid grid-cols-3 gap-8">

                    <h3 class="font-semibold text-[22px]">

                        Tindakan Selanjutnya

                    </h3>

                    <div class="col-span-2">

                        <div
                            class="bg-white rounded-xl p-6 text-[18px] leading-8">

                            Silahkan bantu menginformasikan dan
                            mengajak para ibu dan balita hadir
                            ke Posyandu sesuai jadwal yang
                            ditentukan.

                        </div>

                    </div>

                </div>

            </div>

            <hr class="border-[#8E8E8E] my-10">

            <!-- Button -->

            <div class="flex justify-center">

                <a
                    href="index.php"
                    class="bg-[#875988]
                           hover:bg-[#744A75]
                           text-white
                           rounded-full
                           w-[280px]
                           h-[58px]
                           flex
                           items-center
                           justify-center
                           font-semibold
                           transition">

                    Kembali Ke Beranda

                </a>

            </div>

        </div>

    </div>

</section>