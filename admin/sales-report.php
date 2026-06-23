<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

/*
|--------------------------------------------------------------------------
| SUMMARY
|--------------------------------------------------------------------------
*/

$totalOrders = $db->query("
    SELECT COUNT(*) as total
    FROM orders
")->fetch(PDO::FETCH_ASSOC);

$totalRevenue = $db->query("
    SELECT COALESCE(SUM(total),0) as revenue
    FROM orders
")->fetch(PDO::FETCH_ASSOC);

$totalProducts = $db->query("
    SELECT COALESCE(SUM(quantity),0) as qty
    FROM order_items
")->fetch(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| SALES REPORT
|--------------------------------------------------------------------------
*/

$selectedMonth = $_GET['month'] ?? date('m');
$selectedYear  = $_GET['year'] ?? date('Y');

$totalOrders = $db->query("
    SELECT COUNT(*) total
    FROM orders
    WHERE MONTH(created_at) = $selectedMonth
    AND YEAR(created_at) = $selectedYear
")->fetch(PDO::FETCH_ASSOC);

$totalRevenue = $db->query("
    SELECT COALESCE(SUM(total),0) revenue
    FROM orders
    WHERE MONTH(created_at) = $selectedMonth
    AND YEAR(created_at) = $selectedYear
")->fetch(PDO::FETCH_ASSOC);

$totalProducts = $db->query("
    SELECT COALESCE(SUM(oi.quantity),0) qty
    FROM order_items oi
    JOIN orders o ON oi.order_id = o.id
    WHERE MONTH(o.created_at) = $selectedMonth
    AND YEAR(o.created_at) = $selectedYear
")->fetch(PDO::FETCH_ASSOC);

$bestSeller = $db->query("
    SELECT p.name
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    JOIN orders o ON oi.order_id = o.id
    WHERE MONTH(o.created_at) = $selectedMonth
    AND YEAR(o.created_at) = $selectedYear
    GROUP BY p.id
    ORDER BY SUM(oi.quantity) DESC
    LIMIT 1
")->fetch(PDO::FETCH_ASSOC);

$bestProducts = $db->query("
    SELECT
        p.name,
        p.category,
        SUM(oi.quantity) total_sold,
        SUM(oi.quantity * oi.price) revenue
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    JOIN orders o ON oi.order_id = o.id
    WHERE MONTH(o.created_at) = $selectedMonth
    AND YEAR(o.created_at) = $selectedYear
    GROUP BY p.id
    ORDER BY total_sold DESC
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Sales Report</title>

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

        .page-title{
            font-size:42px;
            font-weight:700;
            color:#543A14;
        }

        .page-subtitle{
            color:#8B7355;
        }

        .summary-card{
            background:#FFF0DC;
            border-radius:24px;
            padding:24px;
            height:100%;
        }

        .summary-title{
            font-size:14px;
            color:#8B7355;
            margin-bottom:10px;
        }

        .summary-value{
            font-size:30px;
            font-weight:700;
            color:#543A14;
        }

        .report-card{
            background:#fff;
            border-radius:24px;
            padding:25px;
            box-shadow:
            0 10px 25px rgba(0,0,0,.05);
        }

        .search-box{
            width:350px;
            border:none;
            outline:none;
            background:#F8F5F0;
            border-radius:999px;
            padding:12px 20px;
        }

        .btn-export{
            background:#543A14;
            color:white;
            border:none;
            border-radius:999px;
            padding:10px 18px;
            text-decoration:none;
            transition:.3s;
        }

        .btn-export:hover{
            background:#3f2a0f;
            color:white;
            text-decoration:none;
        }

        .report-table{
            width:100%;
        }

        .report-table thead th{
            border:none;
            color:#8B7355;
            font-weight:600;
            padding:18px;
        }

        .report-table tbody td{
            padding:20px 18px;
            border-top:1px solid #F2F2F2;
            vertical-align:middle;
        }

        .report-row:hover{
            background:#FAFAFA;
        }

        .status-badge{
            padding:8px 14px;
            border-radius:999px;
            font-size:13px;
            font-weight:600;
        }

        .status-completed{
            background:#E8F8EC;
            color:#1E9B4B;
        }

        .status-pending{
            background:#FFF4E5;
            color:#D97706;
        }

        .form-control{
            height:50px;
            border-radius:14px;
            border:1px solid #E6DFD4;
        }

        .form-control:focus{
            box-shadow:none;
            border-color:#543A14;
        }

        .btn-dark{
            height:50px;
            border:none;
            border-radius:14px;
            background:#543A14;
        }

        .btn-dark:hover{
            background:#3f2a0f;
        }

        .report-card{
            background:#fff;
            border-radius:24px;
            padding:30px;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
        }

    </style>

</head>

<body id="page-top">

<div id="wrapper">

    <?php include '../components/sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <div class="container-fluid px-4 py-4">

                <h1 class="page-title">
                    Sales Report
                </h1>

                <p class="page-subtitle">
                    Track sales performance and revenue
                </p>

                <!-- SUMMARY CARDS -->

                <div class="row mt-4">

                    <div class="col-md-3 mb-3">

                        <div class="summary-card">

                            <div class="summary-title">
                                Total Orders
                            </div>

                            <div class="summary-value">
                                <?= $totalOrders['total']; ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 mb-3">

                        <div class="summary-card">

                            <div class="summary-title">
                                Total Revenue
                            </div>

                            <div class="summary-value">
                                Rp <?= number_format($totalRevenue['revenue'],0,',','.'); ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 mb-3">

                        <div class="summary-card">

                            <div class="summary-title">
                                Products Sold
                            </div>

                            <div class="summary-value">
                                <?= $totalProducts['qty']; ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 mb-3">

                        <div class="summary-card">

                            <div class="summary-title">
                                Best Seller
                            </div>

                            <div class="summary-value" style="font-size:20px;">
                                <?= $bestSeller['name'] ?? '-' ?>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="report-card mb-4">

                    <form method="GET">

                        <div class="row align-items-center">

                        <div class="col-md-4">

                            <label
                                class="font-weight-bold mb-2"
                                style="color:#543A14;">

                                Select Month

                            </label>

                            <select
                                name="month"
                                class="form-control">

                                <?php for($m=1;$m<=12;$m++): ?>

                                <option
                                    value="<?= $m ?>"
                                    <?= $selectedMonth == $m ? 'selected' : '' ?>>

                                    <?= date(
                                        'F',
                                        mktime(0,0,0,$m,1)
                                    ); ?>

                                </option>

                                <?php endfor; ?>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label
                                class="font-weight-bold mb-2"
                                style="color:#543A14;">

                                Select Year

                            </label>

                            <select
                                name="year"
                                class="form-control">

                                <?php for($y=2025;$y<=2030;$y++): ?>

                                <option
                                    value="<?= $y ?>"
                                    <?= $selectedYear == $y ? 'selected' : '' ?>>

                                    <?= $y ?>

                                </option>

                                <?php endfor; ?>

                            </select>

                        </div>

                        <div class="col-md-2">

                            <label class="d-block mb-2">
                                &nbsp;
                            </label>

                            <button
                                class="btn btn-dark w-100">

                                <i class="fas fa-search mr-1"></i>
                                Generate

                            </button>

                        </div>

                        <div class="col-md-3 text-right">

                            <label class="d-block mb-2">
                                Export Report
                            </label>

                            <a
                                href="export-sales-pdf.php?month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                class="btn-export mr-2">

                                <i class="fas fa-file-pdf"></i>

                            </a>

                            <a
                                href="export-sales-excel.php?month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                class="btn-export">

                                <i class="fas fa-file-excel"></i>

                            </a>

                        </div>

                    </div>

                </div>

                <!-- SALES TABLE -->

                <div class="report-card mt-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h4
                                style="
                                color:#543A14;
                                font-weight:700;
                                margin-bottom:5px;">

                                Monthly Sales Report

                            </h4>

                            <p
                                style="
                                color:#8B7355;
                                margin:0;">

                                Top selling products for selected period

                            </p>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table report-table">

                            <thead>

                                <tr>

                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Qty Sold</th>
                                    <th>Revenue</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($bestProducts as $product): ?>

                                <tr>

                                    <td>
                                        <?= htmlspecialchars($product['name']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($product['category']); ?>
                                    </td>

                                    <td>
                                        <?= $product['total_sold']; ?>
                                    </td>

                                    <td>

                                        Rp <?= number_format(
                                            $product['revenue'],
                                            0,
                                            ',',
                                            '.'
                                        ); ?>

                                    </td>

                                </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

                        </div>

                 </form>

            </div>

        </div>

    </div>

</div>

<script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/sb-admin-2.min.js"></script>

</body>
</html>