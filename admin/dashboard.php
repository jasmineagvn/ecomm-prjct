<?php

require_once 'classes/AdminAuth.php';
require_once '../config/database.php';

$auth = new AdminAuth();
$auth->requireLogin();

$database = new Database();
$db = $database->getConnection();

/*
|--------------------------------------------------------------------------
| TOTAL PRODUCTS
|--------------------------------------------------------------------------
*/

$totalProducts = $db
    ->query("SELECT COUNT(*) FROM products")
    ->fetchColumn();

/*
|--------------------------------------------------------------------------
| TOTAL USERS
|--------------------------------------------------------------------------
*/

$totalUsers = $db
    ->query("SELECT COUNT(*) FROM users")
    ->fetchColumn();

/*
|--------------------------------------------------------------------------
| TOTAL ADMINS
|--------------------------------------------------------------------------
*/

$totalAdmins = $db
    ->query("SELECT COUNT(*) FROM admins")
    ->fetchColumn();

/*
|--------------------------------------------------------------------------
| TOTAL ORDERS
|--------------------------------------------------------------------------
*/

try {

    $totalOrders = $db
        ->query("SELECT COUNT(*) FROM orders")
        ->fetchColumn();
} catch (Exception $e) {

    $totalOrders = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Domio Admin</title>

    <link
        href="vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet">

    <link
        href="css/sb-admin-2.min.css"
        rel="stylesheet">

    <style>
        html,
        body,
        #wrapper,
        #content-wrapper,
        #content,
        .container-fluid {
            background: #FFFFFF !important;
            font-family: 'Manrope', sans-serif;
        }

        .domio-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .domio-search {
            width: 380px;
            position: relative;
        }

        .domio-search input {
            width: 100%;
            height: 40px;
            border: 1px solid #EFEAE3;
            border-radius: 999px;
            padding: 0 50px 0 20px;
            outline: none;
            font-size: 13px;
            box-shadow:
                0 4px 12px rgba(0, 0, 0, .04);
        }

        .domio-search button {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #543A14;
        }

        .domio-profile-btn {
            display: flex;
            width: 100%;
            height: 40px;
            font-size: 13px;
            align-items: center;
            gap: 12px;
            background: white;
            border: 1px solid #EFEAE3;
            border-radius: 999px;
            padding: 0 12px;
            box-shadow:
                0 4px 12px rgba(0, 0, 0, .04);
        }

        .domio-avatar {
            width: 30px;
            height: 30px;
            font-size: 13px;
            border-radius: 50%;
            background: #6B4A17;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .dropdown-item:hover {
            background: #FFF8F0;
            color: #543A14;
        }

        .dropdown-item:focus {
            background: #FFF8F0 !important;
            color: #543A14 !important;
        }

        .dropdown-item:active {
            background: #FFF0DC !important;
            color: #543A14 !important;
        }

        .domio-card {
            background: #FFFFFF;
            border: 1px solid #EFEAE3;
            border-radius: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .05);
        }

        .domio-card:hover {
            transform: translateY(-3px);
        }

        .domio-label {
            color: #8B7355;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .domio-number {
            color: #543A14;
            font-size: 34px;
            font-weight: 700;
        }

        .domio-section {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
        }

        .domio-header {
            background: #FFFFFF;
            border-bottom: 1px solid #F2F2F2;
        }

        .domio-table {
            margin-bottom: 0;
        }

        .domio-table thead {
            background: #FFF8F0;
        }

        .domio-table thead th {
            color: #543A14;
            font-weight: 700;
            border: none !important;
            padding: 18px;
        }

        .domio-table tbody td {
            border-top: 1px solid #F1ECE6;
            padding: 18px;
            color: #6B6B6B;
            vertical-align: middle;
        }

        .domio-table tbody tr {
            transition: .2s;
        }

        .domio-table tbody tr:hover {
            background: #FFFCF8;
        }

        .domio-table tbody tr:last-child td {
            border-bottom: none;
        }

        .domio-btn {
            background: #6B4A17;
            color: white !important;
            border-radius: 999px;
            transition: all .3s ease;
            border: none;
        }

        .domio-btn:hover {
            background: #FFF0DC !important;
            color: #543A14 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(107, 74, 23, .15);
        }

        .domio-btn-outline {
            background: #FFFFFF;
            color: #543A14 !important;
            border: 1px solid #D9A86C;
            border-radius: 999px;
            transition: all .3s ease;
        }

        .domio-btn-outline:hover {
            background: #FFF0DC !important;
            color: #543A14 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(107, 74, 23, .12);
        }

        .status {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Pending */
        .status-pending {
            background: #FFF4D6;
            color: #C78A00;
        }

        /* Paid */
        .status-paid {
            background: #DCFCE7;
            color: #15803D;
        }

        /* Processing */
        .status-processing {
            background: #DBEAFE;
            color: #1D4ED8;
        }

        /* Shipped */
        .status-shipped {
            background: #EDE9FE;
            color: #7C3AED;
        }

        /* Completed */
        .status-completed {
            background: #D1FAE5;
            color: #065F46;
        }

        /* Cancelled */
        .status-cancelled {
            background: #FCECEC;
            color: #D84A4A;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <?php include '../components/sidebar.php'; ?>

        <div
            id="content-wrapper"
            class="d-flex flex-column">

            <div class="container-fluid pt-2">

                <!-- TOPBAR -->
                <div class="domio-topbar">

                    <form
                        action="products.php"
                        method="GET"
                        class="domio-search">

                        <input
                            type="text"
                            name="search"
                            placeholder="Search products...">

                        <button type="submit">

                            <i class="fas fa-search"></i>

                        </button>

                    </form>

                    <div class="dropdown">

                        <button
                            class="btn domio-profile-btn"
                            data-toggle="dropdown">

                            <div class="domio-avatar">

                                <?= strtoupper(substr($_SESSION['admin_name'], 0, 1)); ?>

                            </div>

                            <span>

                                <?= $_SESSION['admin_name']; ?>

                            </span>

                            <i class="fas fa-chevron-down ml-2"></i>

                        </button>

                        <div class="dropdown-menu dropdown-menu-right shadow">

                            <a
                                class="dropdown-item"
                                href="profile.php">

                                <i class="fas fa-user mr-2"></i>

                                My Profile

                            </a>

                            <a
                                class="dropdown-item"
                                href="change-password.php">

                                <i class="fas fa-lock mr-2"></i>

                                Change Password

                            </a>

                            <div class="dropdown-divider"></div>

                            <a
                                class="dropdown-item"
                                href="#"
                                data-toggle="modal"
                                data-target="#logoutModal">

                                <i class="fas fa-sign-out-alt mr-2"></i>

                                Logout

                            </a>

                        </div>

                    </div>

                </div>

                <div class="container-fluid px-4 py-4">

                    <!-- TITLE -->
                    <div
                        class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h1
                                class="mb-1"
                                style="
                                    color:#543A14;
                                    font-size:28px;
                                    font-weight:700;
                                    ">

                                Dashboard

                            </h1>

                            <p
                                style="
                                    color:#8B7355;
                                    font-size:15px;
                                    ">

                                Welcome back,
                                <?= $_SESSION['admin_name']; ?>

                            </p>

                        </div>

                    </div>

                    <!-- CARDS -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">

                            <div class="card domio-card h-100">

                                <div class="card-body">

                                    <div class="domio-label">
                                        Products
                                    </div>

                                    <div class="domio-number">
                                        <?= $totalProducts ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">

                            <div class="card domio-card h-100">

                                <div class="card-body">

                                    <div class="domio-label">
                                        Orders
                                    </div>

                                    <div class="domio-number">
                                        <?= $totalOrders ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">

                            <div class="card domio-card h-100">

                                <div class="card-body">

                                    <div class="domio-label">
                                        Users
                                    </div>

                                    <div class="domio-number">
                                        <?= $totalUsers ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">

                            <div class="card domio-card h-100">

                                <div class="card-body">

                                    <div class="domio-label">
                                        Admins
                                    </div>

                                    <div class="domio-number">
                                        <?= $totalAdmins ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ROW 2 -->
                    <div class="row">

                        <!-- RECENT ORDERS -->
                        <div class="col-lg-8 mb-4">

                            <div class="card domio-section">

                                <div class="card-header domio-header">

                                    <h6
                                        class="m-0"
                                        style="
                                            color:#543A14;
                                            font-weight:700;
                                            ">

                                        Recent Orders

                                    </h6>

                                </div>

                                <div class="card-body p-0">

                                    <table class="table domio-table">

                                        <thead>

                                            <tr>

                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Status</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            try {

                                                $recentOrders = $db->query("
                                                    SELECT *
                                                    FROM orders
                                                    ORDER BY id DESC
                                                    LIMIT 5
                                                ");

                                                while ($order = $recentOrders->fetch(PDO::FETCH_ASSOC)) :

                                            ?>

                                                    <tr>

                                                        <td>#<?= $order['id']; ?></td>

                                                        <td>
                                                            <?= $order['fullname']; ?>
                                                        </td>

                                                        <td>

                                                            <span
                                                                class="status status-<?= strtolower($order['status']); ?>">

                                                                <?= ucfirst($order['status']); ?>

                                                            </span>

                                                        </td>

                                                    </tr>

                                                <?php endwhile;
                                            } catch (Exception $e) { ?>

                                                <tr>

                                                    <td colspan="3">
                                                        No orders available
                                                    </td>

                                                </tr>

                                            <?php } ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <!-- QUICK ACTION -->
                        <div class="col-lg-4 mb-4">

                            <div class="card domio-section">

                                <div class="card-header domio-header">

                                    <h6
                                        class="m-0"
                                        style="
                                            color:#543A14;
                                            font-weight:700;
                                            ">

                                        Quick Actions

                                    </h6>

                                </div>

                                <div class="card-body">

                                    <a
                                        href="add-product.php"
                                        class="btn btn-block mb-3 domio-btn">

                                        Add Product

                                    </a>

                                    <a
                                        href="products.php"
                                        class="btn btn-block mb-3 domio-btn">

                                        Manage Products

                                    </a>

                                    <a
                                        href="orders.php"
                                        class="btn btn-block mb-3 domio-btn">

                                        View Orders

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- LATEST PRODUCTS -->
                    <div class="card domio-section mb-4">

                        <div class="card-header domio-header">

                            <h6
                                class="m-0"
                                style="
                                    color:#543A14;
                                    font-weight:700;
                                    ">

                                Latest Products

                            </h6>

                        </div>

                        <div class="card-body p-0">

                            <table class="table domio-table">

                                <thead>

                                    <tr>

                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Category</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    $products = $db->query("
                                        SELECT *
                                        FROM products
                                        ORDER BY id DESC
                                        LIMIT 5
                                    ");

                                    while ($product = $products->fetch(PDO::FETCH_ASSOC)) :

                                    ?>

                                        <tr>

                                            <td><?= $product['id']; ?></td>

                                            <td><?= $product['name']; ?></td>

                                            <td
                                                style="
                                                    font-weight:600;
                                                    color:#543A14;
                                                    ">

                                                Rp<?= number_format($product['price'], 2); ?>

                                            </td>

                                            <td><?= $product['category']; ?></td>

                                        </tr>

                                    <?php endwhile; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <script src="vendor/jquery/jquery.min.js"></script>

                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>