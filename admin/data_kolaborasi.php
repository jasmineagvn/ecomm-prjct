<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "janjibaik_db");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Tangkap keyword pencarian jika ada
$cari = isset($_GET['cari']) ? $koneksi->real_escape_string($_GET['cari']) : '';
if ($cari !== '') {
    $query = "SELECT * FROM kolaborasi 
              WHERE nama_lengkap LIKE '%$cari%' 
                 OR email LIKE '%$cari%' 
                 OR no_hp LIKE '%$cari%'";
} else {
    $query = "SELECT * FROM kolaborasi ORDER BY created_at ASC";
}
$result = $koneksi->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Data Kolaborasi - JANJI BAIK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Header -->
<header class="bg-white shadow-md fixed top-0 w-full z-10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="../assets/logo.png" alt="Logo" class="h-10 w-15 object-contain" />
            <span class="text-gray-400">|</span>
            <span class="text-gray-600">Data Kolaborasi</span>
        </div>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <div class="w-9 h-9 bg-[#01B4BB] rounded-full flex items-center justify-center text-white font-semibold">
                    <?= strtoupper(substr($_SESSION['admin_nama'], 0, 1)); ?>
                </div>
                <span class="text-gray-700">Halo, <?= htmlspecialchars($_SESSION['admin_nama']); ?></span>
            </div>
            <a href="profile.php" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-md text-sm">Profile</a>
            <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm">Logout</a>
        </div>
    </div>
</header>

<main class="pt-24 px-6 pb-10 max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-[#01B4BB] mb-4">Data Kolaborasi</h2>

        <!-- SweetAlert2 Notifikasi Sukses Edit -->
        <?php if (isset($_SESSION['kolab_edit_success'])): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '<?= addslashes($_SESSION['kolab_edit_success']) ?>',
                        confirmButtonColor: '#3085d6'
                    });
                });
            </script>
            <?php unset($_SESSION['kolab_edit_success']); ?>
        <?php endif; ?>

        <!-- Form Pencarian -->
        <form method="GET" class="mb-4">
            <div class="flex items-center space-x-2">
                <input
                    type="text"
                    name="cari"
                    placeholder="Cari nama, email atau no. HP..."
                    value="<?= htmlspecialchars($cari); ?>"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                />
                <button type="submit" class="bg-[#01B4BB] hover:bg-blue-700 text-white px-4 py-2 rounded-md">Cari</button>
                <?php if ($cari !== ''): ?>
                    <a href="data_kolaborasi.php" class="text-sm text-red-500 hover:underline">Reset</a>
                <?php endif; ?>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-blue-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 border-b">No</th>
                        <th class="py-3 px-4 border-b">Nama</th>
                        <th class="py-3 px-4 border-b">Email</th>
                        <th class="py-3 px-4 border-b">No. HP</th>
                        <th class="py-3 px-4 border-b">Jenis Kolaborasi</th>
                        <th class="py-3 px-4 border-b">Deskripsi</th>
                        <th class="py-3 px-4 border-b">Pesan</th>
                        <th class="py-3 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr class="even:bg-gray-50">
                        <td class="py-3 px-4 border-b"><?= $no++; ?></td>
                        <td class="py-3 px-4 border-b"><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td class="py-3 px-4 border-b"><?= htmlspecialchars($row['email']); ?></td>
                        <td class="py-3 px-4 border-b"><?= htmlspecialchars($row['no_hp']); ?></td>
                        <td class="py-3 px-4 border-b"><?= htmlspecialchars($row['jenis_kolaborasi']); ?></td>
                        <td class="py-3 px-4 border-b"><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="py-3 px-4 border-b"><?= htmlspecialchars($row['pesan']); ?></td>
                        <td class="py-3 px-4 border-b">
                            <div class="flex space-x-2">
                                <button
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-blue-200 transition"
                                    onclick="openEditModal(<?= $row['id']; ?>, '<?= addslashes($row['nama_lengkap']); ?>', '<?= addslashes($row['email']); ?>', '<?= addslashes($row['no_hp']); ?>')">
                                    Edit
                                </button>
                                <button
                                    class="hapus-kolaborasi-button bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-red-200 transition"
                                    data-id="<?= $row['id']; ?>">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6 text-left">
        <a href="dashboard.php" class="inline-flex items-center bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded-lg text-sm transition">
            ← Kembali ke Dashboard
        </a>
    </div>
</main>

<!-- Modal Edit Kolaborasi (Hanya Nama, Email, No. HP) -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h3 class="text-xl font-semibold text-gray-700">✏️ Edit Kolaborasi</h3>
            <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form method="POST" action="edit_kolaborasi_modal.php" class="space-y-4">
            <input type="hidden" name="id" id="edit_id">

            <div>
                <label for="edit_nama" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="edit_nama" required
                       class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2" />
            </div>
            <div>
                <label for="edit_email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="edit_email" required
                       class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2" />
            </div>
            <div>
                <label for="edit_no_hp" class="block text-sm font-medium text-gray-600">No. HP</label>
                <input type="text" name="no_hp" id="edit_no_hp" required
                       class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2" />
            </div>
            <div class="flex justify-end space-x-2 pt-4 border-t">
                <button type="button" onclick="closeEditModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                    Batal
                </button>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Buka modal edit dan isi field hanya Nama, Email, No HP
function openEditModal(id, nama, email, no_hp) {
    document.getElementById('edit_id').value     = id;
    document.getElementById('edit_nama').value   = nama;
    document.getElementById('edit_email').value  = email;
    document.getElementById('edit_no_hp').value  = no_hp;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

// Tutup modal jika diklik di luar isi modal
window.addEventListener('click', (e) => {
    const modal = document.getElementById('editModal');
    if (e.target === modal) {
        closeEditModal();
    }
});

// SweetAlert2 konfirmasi hapus kolaborasi
document.querySelectorAll('.hapus-kolaborasi-button').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.dataset.id;
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data kolaborasi yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `hapus_kolaborasi.php?id=${id}`;
            }
        });
    });
});
</script>

</body>
</html>
