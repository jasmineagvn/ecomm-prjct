<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$stmt = $db->query("
    SELECT *
    FROM orders
    ORDER BY created_at DESC
");

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Orders</title>

    <link
        href="vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet">

    <link
        href="css/sb-admin-2.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #fff;
        }

        .page-title {
            font-size: 42px;
            font-weight: 700;
            color: #543A14;
        }

        .page-subtitle {
            color: #8B7355;
        }

        .orders-card {
            background: #fff;
            border-radius: 24px;
            padding: 25px;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, .05);
        }

        .search-box {
            width: 350px;
            border: none;
            outline: none;
            background: #F8F5F0;
            border-radius: 999px;
            padding: 12px 20px;
        }

        .order-table {
            width: 100%;
        }

        .order-table thead th {
            border: none;
            color: #8B7355;
            font-weight: 600;
            padding: 18px;
        }

        .order-table tbody td {
            padding: 20px 18px;
            border-top: 1px solid #F2F2F2;
            vertical-align: middle;
        }

        .order-row:hover {
            background: #FAFAFA;
        }

        .status {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-pending {
            background: #FFF4D6;
            color: #C78A00;
        }

        .status-processing {
            background: #EAF3FF;
            color: #2F73D9;
        }

        .status-completed {
            background: #E8F8EC;
            color: #1E9B4B;
        }

        .status-cancelled {
            background: #FCECEC;
            color: #D84A4A;
        }

        .btn-view-order {
            background: #131010;
            color: #fff !important;
            padding: 10px 18px;
            border-radius: 999px;
            text-decoration: none;
            transition: .3s;
        }

        .btn-view-order:hover {
            background: #543A14;
            text-decoration: none;
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

                        Orders

                    </h1>

                    <p class="page-subtitle">

                        View and manage customer orders

                    </p>

                    <div class="orders-card mt-4">

                        <div
                            class="d-flex justify-content-between align-items-center mb-4">

                            <h5 class="mb-0">

                                All Orders

                            </h5>

                            <input
                                type="text"
                                id="searchOrder"
                                class="search-box"
                                placeholder="Search customer...">

                        </div>

                        <div class="table-responsive">

                            <table class="table order-table">

                                <thead>

                                    <tr>

                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody id="orderTable">

                                    <?php foreach ($orders as $order): ?>

                                        <tr class="order-row">

                                            <td>

                                                #<?= $order['id']; ?>

                                            </td>

                                            <td>

                                                <?= htmlspecialchars($order['fullname']); ?>

                                            </td>

                                            <td>

                                                $
                                                <?= number_format($order['total'], 2); ?>

                                            </td>

                                            <td>

                                                <?= htmlspecialchars($order['payment_method']); ?>

                                            </td>

                                            <td>

                                                <span
                                                    class="status status-<?= strtolower($order['status']); ?>">

                                                    <?= ucfirst($order['status']); ?>

                                                </span>

                                            </td>

                                            <td>

                                                <?= date(
                                                    'd M Y',
                                                    strtotime($order['created_at'])
                                                ); ?>

                                            </td>

                                            <td>

                                                <a
                                                    href="order-detail.php?id=<?= $order['id']; ?>"
                                                    class="btn-view-order">

                                                    View

                                                </a>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        const searchInput =
            document.getElementById('searchOrder');

        searchInput.addEventListener(
            'keyup',
            function() {

                let value =
                    this.value.toLowerCase();

                let rows =
                    document.querySelectorAll(
                        '#orderTable tr'
                    );

                rows.forEach(row => {

                    row.style.display =
                        row.innerText
                        .toLowerCase()
                        .includes(value) ?
                        '' :
                        'none';

                });

            }
        );
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>