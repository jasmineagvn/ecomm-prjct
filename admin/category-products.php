<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$category = $_GET['category'] ?? '';

$stmt = $db->prepare("
    SELECT *
    FROM products
    WHERE category = ?
    ORDER BY id DESC
");

$stmt->execute([$category]);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= $category ?> Products</title>

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
            font-size: 34px;
            font-weight: 700;
            color: #543A14;
            margin-bottom: 0;
        }

        .page-subtitle {
            color: #8B7355;
            margin-top: 6px;
        }

        .domio-btn {
            background: #131010;
            color: #fff !important;
            border: none;
            padding: 10px 22px;
            height: 45px;
            border-radius: 999px;
            transition: .5s;
        }

        .domio-btn:hover {
            background: #543A14;
            text-decoration: none;
        }

        .product-card {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, .06);
            height: 100%;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f8f8f8;
        }

        .product-content {
            padding: 20px;
        }

        .product-title {
            font-size: 18px;
            font-weight: 700;
            color: #131010;
            margin-bottom: 10px;
        }

        .product-description {
            color: #777;
            font-size: 14px;
            min-height: 42px;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .product-price {
            color: #131010;
            font-size: 20px;
            font-weight: 700;
        }

        .back-btn {
            color: #8B7355;
            font-weight: 500;
        }

        .back-btn:hover {
            color: #131010;
            text-decoration: none;
        }

        .product-action {
            flex: 1;
            background: #131010;
            color: white !important;
            border: none;
            height: 35px;
            border-radius: 999px;
            transition: .3s;
            font-size: 13px;
        }

        .product-action:hover {
            background: #543A14;
            color: white;
        }

        .btn-delete {
            flex: 1;
            background: #FBEAEA;
            color: #B85C5C !important;
            border: none;
            height: 35px;
            font-size: 13px;
            border-radius: 999px;
            transition: .3s;
        }

        .btn-delete:hover {
            background: #E8CFCF;
            color: #8E3E3E !important;
        }

        .delete-modal {
            border: none;
            border-radius: 30px;
            overflow: hidden;
            padding: 25px;
        }

        .delete-title {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #131010;
            margin-bottom: 15px;
        }

        .delete-text {
            text-align: center;
            color: #8A8A8A;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .delete-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
        }

        .btn-cancel {
            min-width: 160px;
            height: 60px;
            border-radius: 999px;
            border: 1px solid #D8CBB9;
            background: #fff;
            color: #131010;
            font-size: 24px;
            transition: .3s;
        }

        .btn-cancel:hover {
            background: #F8F5F0;
        }

        .btn-confirm-delete {
            min-width: 160px;
            height: 60px;
            border-radius: 999px;
            background: #131010;
            color: #fff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 24px;
            transition: .3s;
        }

        .btn-confirm-delete:hover {
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

                    <!-- HEADER -->

                    <div
                        class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <a
                                href="products.php"
                                class="back-btn">

                                <i class="fas fa-arrow-left mr-2"></i>

                                Back to Categories

                            </a>

                            <h1 class="page-title mt-3">

                                <?= htmlspecialchars($category) ?>

                            </h1>

                            <p class="page-subtitle">

                                Manage products in this collection

                            </p>

                        </div>

                        <a
                            href="add-product.php?category=<?= urlencode($category) ?>"
                            class="domio-btn">

                            <i class="fas fa-plus mr-2"></i>

                            Add Product

                        </a>

                    </div>

                    <!-- PRODUCTS -->

                    <div class="row">

                        <?php foreach ($products as $product): ?>

                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

                                <div class="product-card">

                                    <img
                                        src="../<?= $product['image']; ?>"
                                        class="product-image">

                                    <div class="product-content">

                                        <h5 class="product-title">

                                            <?= $product['name']; ?>

                                        </h5>

                                        <p class="product-description">

                                            <?= $product['description']; ?>

                                        </p>

                                        <div class="product-footer">

                                            <div class="product-price">

                                                $
                                                <?= number_format($product['price'], 2); ?>

                                            </div>

                                        </div>

                                        <div class="mt-3 d-flex">

                                            <a
                                                href="product-detail.php?id=<?= $product['id']; ?>"
                                                class="btn product-action mr-2">

                                                View

                                            </a>

                                            <a
                                                href="edit-product.php?id=<?= $product['id']; ?>"
                                                class="btn product-action mr-2">

                                                Edit

                                            </a>

                                            <button
                                                type="button"
                                                class="btn-delete"
                                                data-toggle="modal"
                                                data-target="#deleteModal<?= $product['id']; ?>">

                                                Delete

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div
                                class="modal fade"
                                id="deleteModal<?= $product['id']; ?>"
                                tabindex="-1">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content delete-modal">

                                        <div class="modal-body">

                                            <h2 class="delete-title">

                                                Delete Product

                                            </h2>

                                            <p class="delete-text">

                                                Are you sure you want to delete

                                                <strong>
                                                    <?= $product['name']; ?>
                                                </strong>

                                                ?

                                            </p>

                                            <div class="delete-actions">

                                                <button
                                                    type="button"
                                                    class="btn-cancel"
                                                    data-dismiss="modal">

                                                    Cancel

                                                </button>

                                                <a
                                                    href="delete-product.php?id=<?= $product['id']; ?>"
                                                    class="btn-confirm-delete">

                                                    Delete

                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>