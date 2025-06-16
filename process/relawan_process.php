<?php
// relawan_process.php

$conn = mysqli_connect("localhost", "root", "", "janjibaik_db");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nama_lengkap = $_POST['nama_lengkap'];
$nama_panggilan = $_POST['nama_panggilan'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$divisi = $_POST['divisi'];
$sosial_media = $_POST['sosial_media'];
$pendidikan = $_POST['pendidikan'];
$alasan = $_POST['alasan'];
$pengalaman = $_POST['pengalaman'];
$tanggung_jawab = $_POST['tanggung_jawab'];
$kesibukan = $_POST['kesibukan'];
$kritik_saran = $_POST['kritik_saran'];

$query = "INSERT INTO relawan (
    nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir, no_hp, alamat,
    divisi, sosial_media, pendidikan, alasan, pengalaman, tanggung_jawab,
    kesibukan, kritik_saran
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ssssssssssssss',
    $nama_lengkap, $nama_panggilan, $tempat_lahir, $tanggal_lahir, $no_hp, $alamat,
    $divisi, $sosial_media, $pendidikan, $alasan, $pengalaman, $tanggung_jawab,
    $kesibukan, $kritik_saran
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../successpagerelawan.php");
} else {
    echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
}
?>
