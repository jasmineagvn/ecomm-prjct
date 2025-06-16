    <?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "janjibaik_db");

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $email = $_POST['email'];
    $nama = $_POST['nama_lengkap'];
    $lembaga = $_POST['nama_lembaga'];
    $no_hp = $_POST['no_hp'];
    $jenis = $_POST['jenis_kolaborasi'];
    $deskripsi = $_POST['deskripsi'];
    $pesan = $_POST['pesan'];

    $query = "INSERT INTO kolaborasi (email, nama_lengkap, nama_lembaga, no_hp, jenis_kolaborasi, deskripsi, pesan) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $email, $nama, $lembaga, $no_hp, $jenis, $deskripsi, $pesan);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Data kamu sedang ditindaklanjuti. Tunggu kami menghubungi, ya!";
        header("Location: ../forms/kolaborasi_form.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
