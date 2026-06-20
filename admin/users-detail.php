<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id = (int) $_GET['id'];

$stmt = $db->prepare("
    SELECT *
    FROM users
    WHERE id = ?
");

$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User tidak ditemukan");
}

// TOTAL ORDER
$stmt = $db->prepare("
    SELECT COUNT(*)
    FROM orders
    WHERE user_id = ?
");

$stmt->execute([$id]);

$totalOrders = $stmt->fetchColumn();


// ORDER SELESAI
$stmt = $db->prepare("
    SELECT COUNT(*)
    FROM orders
    WHERE user_id = ?
    AND status = 'completed'
");

$stmt->execute([$id]);

$completedOrders = $stmt->fetchColumn();


// ORDER PENDING
$stmt = $db->prepare("
    SELECT COUNT(*)
    FROM orders
    WHERE user_id = ?
    AND status = 'pending'
");

$stmt->execute([$id]);

$pendingOrders = $stmt->fetchColumn();


// TOTAL BELANJA
$stmt = $db->prepare("
    SELECT SUM(total)
    FROM orders
    WHERE user_id = ?
");

$stmt->execute([$id]);

$totalSpent = $stmt->fetchColumn();

if (!$totalSpent) {
    $totalSpent = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Detail</title>

<link
href="vendor/fontawesome-free/css/all.min.css"
rel="stylesheet">

<link
href="css/sb-admin-2.min.css"
rel="stylesheet">

<style>

body{
    background:#fff;
}

.section-title{
    font-size:42px;
    font-weight:700;
    color:#543A14;
}

.card-custom{
    background:#fff;
    border-radius:24px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.info-row{
    font-size:18px;
    margin-bottom:15px;
}

.label{
    font-weight:600;
    color:#543A14;
    display:inline-block;
    width:150px;
}

.back-btn{
    background:#131010;
    color:white;
    padding:12px 20px;
    border-radius:999px;
    text-decoration:none;
}

.back-btn:hover{
    color:white;
    background:#543A14;
}

.btn-delete {
    background: #D84A4A;
    color: white !important;
    padding: 10px 20px;
    border-radius: 999px;
    text-decoration: none;
    transition: .3s;
    font-weight: 600;
}

.btn-delete:hover {
    background: #B93636;
    color: white !important;
    text-decoration: none;
}

</style>

</head>

<body id="page-top">

<div id="wrapper">

<?php include '../components/sidebar.php'; ?>

<div id="content-wrapper">

<div class="container-fluid px-4 py-4">

<h1 class="section-title">
User Detail
</h1>

<p class="text-muted">
Customer Information
</p>

<!-- INFORMASI USER -->

<h3 class="mt-5 mb-3">
Informasi User
</h3>

<div class="card-custom">

<div class="info-row">
<span class="label">Username</span>
: <?= htmlspecialchars($user['username']) ?>
</div>

<div class="info-row">
<span class="label">Email</span>
: <?= htmlspecialchars($user['email']) ?>
</div>

<div class="info-row">
<span class="label">Member Sejak</span>
: <?= date('d F Y', strtotime($user['created_at'])) ?>
</div>

</div>

<!-- STATISTIK -->

<h3 class="mt-5 mb-3">
Statistik
</h3>

<div class="card-custom">

<div class="info-row">
    <span class="label">Total Order</span>
    : <?= $totalOrders ?>
</div>

<div class="info-row">
    <span class="label">Order Selesai</span>
    : <?= $completedOrders ?>
</div>

<div class="info-row">
    <span class="label">Order Pending</span>
    : <?= $pendingOrders ?>
</div>

<div class="info-row mt-4">
    <span class="label">Total Belanja</span>
    : Rp <?= number_format($totalSpent,0,',','.') ?>
</div>

</div>

    <div class="mt-4 d-flex">

        <a href="users.php" class="back-btn mr-2">
            ← Kembali
        </a>

        <a
            href="delete-user.php?id=<?= $user['id']; ?>"
            class="btn-delete"
            onclick="return confirm('Yakin ingin menghapus user ini?')">

            Delete User

        </a>

    </div>

</div>

</div>

</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>