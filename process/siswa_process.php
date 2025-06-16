<?php
session_start();
require_once '../config/database.php';

$db = new Database();
$conn = $db->getConnection(); // PDO connection

if (!$conn) {
    die("Koneksi database gagal.");
}

// Pastikan data session dan POST ada
if (!isset($_SESSION['data_diri'], $_SESSION['data_ortu'], $_POST['kontak_nama'])) {
    die("Data tidak lengkap.");
}

$data_diri = $_SESSION['data_diri'];
$data_ortu = $_SESSION['data_ortu'];
$data_kontak = $_POST;

$query = "INSERT INTO siswa (
    nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, umur, nik, tingkatan_dituju, kelas_dituju, kelas_terakhir, status_keluarga,
    alamat, status_tempat_tinggal, kwh_listrik, riwayat_penyakit, alasan_melanjutkan,

    ayah_nama, ayah_agama, ayah_pendidikan, ayah_pekerjaan, ayah_penghasilan, ayah_riwayat_penyakit, ayah_alamat, ayah_nohp,
    ibu_nama, ibu_agama, ibu_pendidikan, ibu_pekerjaan, ibu_penghasilan, ibu_riwayat_penyakit, ibu_alamat, ibu_nohp,
    wali_nama, wali_agama, wali_pendidikan, wali_pekerjaan, wali_penghasilan, wali_riwayat_penyakit, wali_alamat, wali_nohp,

    kontak_nama, kontak_hubungan, kontak_alamat, kontak_nohp
) VALUES (
    :nama_lengkap, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :umur, :nik, :tingkatan_dituju, :kelas_dituju, :kelas_terakhir, :status_keluarga,
    :alamat, :status_tempat_tinggal, :kwh_listrik, :riwayat_penyakit, :alasan_melanjutkan,

    :ayah_nama, :ayah_agama, :ayah_pendidikan, :ayah_pekerjaan, :ayah_penghasilan, :ayah_riwayat_penyakit, :ayah_alamat, :ayah_nohp,
    :ibu_nama, :ibu_agama, :ibu_pendidikan, :ibu_pekerjaan, :ibu_penghasilan, :ibu_riwayat_penyakit, :ibu_alamat, :ibu_nohp,
    :wali_nama, :wali_agama, :wali_pendidikan, :wali_pekerjaan, :wali_penghasilan, :wali_riwayat_penyakit, :wali_alamat, :wali_nohp,

    :kontak_nama, :kontak_hubungan, :kontak_alamat, :kontak_nohp
)";

$stmt = $conn->prepare($query);

$params = [
    // Data Diri
    'nama_lengkap' => $data_diri['nama_lengkap'],
    'jenis_kelamin' => $data_diri['jenis_kelamin'],
    'tempat_lahir' => $data_diri['tempat_lahir'],
    'tanggal_lahir' => $data_diri['tanggal_lahir'],
    'umur' => $data_diri['umur'],
    'nik' => $data_diri['nik'],
    'tingkatan_dituju' => $data_diri['tingkatan_dituju'],
    'kelas_dituju' => $data_diri['kelas_dituju'],
    'kelas_terakhir' => $data_diri['kelas_terakhir'],
    'status_keluarga' => $data_diri['status_keluarga'],
    'alamat' => $data_diri['alamat'],
    'status_tempat_tinggal' => $data_diri['status_tempat_tinggal'],
    'kwh_listrik' => $data_diri['kwh_listrik'],
    'riwayat_penyakit' => $data_diri['riwayat_penyakit'],
    'alasan_melanjutkan' => $data_diri['alasan_melanjutkan'],

    // Data Orang Tua
    'ayah_nama' => $data_ortu['ayah_nama'],
    'ayah_agama' => $data_ortu['ayah_agama'],
    'ayah_pendidikan' => $data_ortu['ayah_pendidikan'],
    'ayah_pekerjaan' => $data_ortu['ayah_pekerjaan'],
    'ayah_penghasilan' => $data_ortu['ayah_penghasilan'],
    'ayah_riwayat_penyakit' => $data_ortu['ayah_riwayat_penyakit'],
    'ayah_alamat' => $data_ortu['ayah_alamat'],
    'ayah_nohp' => $data_ortu['ayah_nohp'],

    'ibu_nama' => $data_ortu['ibu_nama'],
    'ibu_agama' => $data_ortu['ibu_agama'],
    'ibu_pendidikan' => $data_ortu['ibu_pendidikan'],
    'ibu_pekerjaan' => $data_ortu['ibu_pekerjaan'],
    'ibu_penghasilan' => $data_ortu['ibu_penghasilan'],
    'ibu_riwayat_penyakit' => $data_ortu['ibu_riwayat_penyakit'],
    'ibu_alamat' => $data_ortu['ibu_alamat'],
    'ibu_nohp' => $data_ortu['ibu_nohp'],

    'wali_nama' => $data_ortu['wali_nama'],
    'wali_agama' => $data_ortu['wali_agama'],
    'wali_pendidikan' => $data_ortu['wali_pendidikan'],
    'wali_pekerjaan' => $data_ortu['wali_pekerjaan'],
    'wali_penghasilan' => $data_ortu['wali_penghasilan'],
    'wali_riwayat_penyakit' => $data_ortu['wali_riwayat_penyakit'],
    'wali_alamat' => $data_ortu['wali_alamat'],
    'wali_nohp' => $data_ortu['wali_nohp'],

    // Kontak Darurat
    'kontak_nama' => $data_kontak['kontak_nama'],
    'kontak_hubungan' => $data_kontak['kontak_hubungan'],
    'kontak_alamat' => $data_kontak['kontak_alamat'],
    'kontak_nohp' => $data_kontak['kontak_nohp']
];

// Jalankan query
if ($stmt->execute($params)) {
    // Bersihkan session jika perlu
    unset($_SESSION['data_diri'], $_SESSION['data_ortu']);
    
    header("Location: ../successpagesiswa.php");
} else {
    $errorInfo = $stmt->errorInfo();
    echo "<script>alert('Terjadi kesalahan: " . htmlspecialchars($errorInfo[2]) . "');</script>";
}
