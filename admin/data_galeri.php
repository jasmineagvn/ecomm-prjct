<?php
require_once '../classes/Auth.php';
require_once '../config/database.php';

$auth = new Auth();
$auth->requireLogin();

$database = new Database();
$db = $database->getConnection();

// Ambil data galeri
try {
    $stmt = $db->prepare("SELECT * FROM galeri ORDER BY created_at ASC");
    $stmt->execute();
    $galeriList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $galeriList = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Galeri - JANJI BAIK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="../assets/logo.png" alt="Logo" class="h-10 w-15 object-contain" />
            <span class="text-gray-400">|</span>
            <span class="text-gray-600">Galeri</span>
        </div>
        <div class="flex space-x-2">
            <!-- Tombol Kembali -->
            <a href="dashboard.php"
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
               ← Kembali ke Dashboard
            </a>

            <!-- Tombol Tambah Galeri -->
            <a href="/janji-baik/admin/galeri_form.php"
               class="px-4 py-2 bg-[#01B4BB] text-white rounded hover:bg-blue-700 transition">
               + Tambah Galeri
            </a>
        </div>
    </div>
</header>

<!-- Main -->
<main class="max-w-6xl mx-auto p-6">
    <?php if (count($galeriList) === 0): ?>
        <p class="text-gray-600">Belum ada galeri ditambahkan.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($galeriList as $galeri): ?>
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden group">
                    <a href="detail_galeri.php?id=<?php echo $galeri['id']; ?>">
                        <?php if ($galeri['thumbnail']): ?>
                            <img src="../uploads/galeri/<?php echo htmlspecialchars($galeri['thumbnail']); ?>"
                                 alt="Thumbnail"
                                 class="w-full h-48 object-cover">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800 truncate">
                                <?php echo htmlspecialchars($galeri['judul']); ?>
                            </h2>
                            <p class="text-sm text-gray-500">
                                <?php echo date('d M Y', strtotime($galeri['created_at'])); ?>
                            </p>
                        </div>
                    </a>
                    <div class="flex justify-between items-center p-4 border-t">
                        <a href="edit_galeri.php?id=<?php echo $galeri['id']; ?>"
                           class="text-blue-600 text-sm hover:underline">
                           Edit
                        </a>
                        <form class="hapus-galeri-form" action="hapus_galeri.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $galeri['id']; ?>">
                            <button type="submit" 
                                    class="text-red-600 text-sm hover:underline focus:outline-none">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<!-- SweetAlert2 Script untuk Konfirmasi Hapus -->
<script>
// Pilih semua form dengan class 'hapus-galeri-form'
document.querySelectorAll('.hapus-galeri-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // cegah form langsung submit

        // Tampilkan SweetAlert2
        Swal.fire({
            title: 'Yakin ingin menghapus galeri ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna memilih "Ya, Hapus!", submit form
                form.submit();
            }
        });
    });
});
</script>

</body>
</html>
