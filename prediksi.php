<?php

session_start();

include 'components/header.php';
?>

<!-- Start : Form Prediksi -->
<section class="bg-white py-24">

    <div class="max-w-5xl mx-auto px-8">

        <!-- Heading -->
        <div class="text-center mb-16">

            <h1 class="text-[46px] font-bold leading-tight">

                Prediksi
                <span class="text-[#875988]">
                    Kehadiran Posyandu
                </span>

            </h1>

            <p class="mt-4 text-[#555555] text-[16px] leading-7 max-w-3xl mx-auto">

                Silakan lengkapi parameter di bawah ini berdasarkan kondisi balita.
                Sistem akan menganalisis dan memprediksi kemungkinan kehadiran
                menggunakan metode Naive Bayes secara objektif.

            </p>

        </div>

        <!-- Form -->
        <form action="hasil-prediksi.php" method="POST" class="space-y-8">

            <!-- Nama Balita -->
            <div>

                <label class="block mb-2 text-[15px] font-semibold text-[#1F1F1F]">

                    Nama Balita
                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="id_balita"
                    required
                    class="w-full h-14 px-5 rounded-xl border border-[#D9B6DA] focus:outline-none focus:border-[#875988]">

                    <option value="">Pilih Nama</option>

                    <option>Aziza</option>
                    <option>Nayla</option>
                    <option>Rafa</option>

                </select>

            </div>

            <!-- Alamat -->
            <div>

                <label class="block mb-2 text-[15px] font-semibold">

                    Alamat
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    name="alamat"
                    placeholder="Ketik Alamat"
                    required
                    class="w-full h-14 px-5 rounded-xl border border-[#D9B6DA] focus:outline-none focus:border-[#875988]">

            </div>

            <!-- Usia -->
            <div>

                <label class="block mb-2 text-[15px] font-semibold">

                    Usia Balita
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    name="usia"
                    placeholder="Contoh : 24 Bulan"
                    required
                    class="w-full h-14 px-5 rounded-xl border border-[#D9B6DA] focus:outline-none focus:border-[#875988]">

            </div>

            <!-- Jarak -->
            <div>

                <label class="block mb-2 text-[15px] font-semibold">

                    Jarak Tempat Tinggal
                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="jarak"
                    required
                    class="w-full h-14 px-5 rounded-xl border border-[#D9B6DA] focus:outline-none focus:border-[#875988]">

                    <option value="">Pilih Jarak</option>
                    <option>Dekat</option>
                    <option>Sedang</option>
                    <option>Jauh</option>

                </select>

            </div>

            <!-- Status Gizi -->
            <div>

                <label class="block mb-2 text-[15px] font-semibold">

                    Status Gizi
                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="status_gizi"
                    required
                    class="w-full h-14 px-5 rounded-xl border border-[#D9B6DA] focus:outline-none focus:border-[#875988]">

                    <option value="">Pilih Status Gizi</option>
                    <option>Baik</option>
                    <option>Kurang</option>
                    <option>Buruk</option>
                    <option>Resiko Gizi Lebih</option>
                    <option>Obesitas</option>

                </select>

            </div>

            <!-- Riwayat Kehadiran -->
            <div>

                <label class="block mb-2 text-[15px] font-semibold">

                    Riwayat Kehadiran
                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="riwayat"
                    required
                    class="w-full h-14 px-5 rounded-xl border border-[#D9B6DA] focus:outline-none focus:border-[#875988]">

                    <option value="">Pilih Riwayat Kehadiran</option>
                    <option>Rutin</option>
                    <option>Tidak Rutin</option>

                </select>

            </div>

            <!-- Button -->
            <div class="flex justify-end pt-4">

    <a
        href="hasil.php"
        class="w-[140px]
               h-[50px]
               bg-[#875988]
               hover:bg-[#744A75]
               rounded-full
               text-white
               font-medium
               flex
               items-center
               justify-center
               transition-all
               duration-300">

        Cek Prediksi

    </a>

</div>
        </form>

    </div>

</section>
<!-- End : Form Prediksi -->
 
<?php include 'components/footer.php' ?>