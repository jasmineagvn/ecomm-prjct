<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$id = $_GET['id'] ?? 0;

$stmt = $db->prepare("
    SELECT *
    FROM products
    WHERE id = ?
");

$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {

    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= $product['name']; ?>
    </title>

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

        .back-btn {

            color: #8B7355;
            font-size: 16px;
            font-weight: 500;
        }

        .back-btn:hover {

            color: #131010;
            text-decoration: none;
        }

        .detail-card {
            background: #fff;
            border-radius: 24px;
            padding: 25px;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, .05);
            height: 100%;
        }

        .detail-image {
            width: 100%;
            height: 300px;
            object-fit: contain;
            border-radius: 16px;
        }

        .product-category {
            display: inline-block;
            background: #F8F4EF;
            color: #8B7355;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
        }

        .product-name {
            font-size: 32px;
            font-weight: 700;
            color: #131010;
            margin-top: 25px;
            margin-bottom: 20px;
        }

        .product-price {
            color: #543A14;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .product-description {
            color: #666;
            line-height: 1.9;
            font-size: 15px;
            max-width: 600px;
        }

        .domio-btn {
            display: inline-block;
            margin-top: 20px;
            background: #131010;
            color: #fff !important;
            padding: 12px 30px;
            border-radius: 999px;
            text-decoration: none;
            transition: .3s;
        }

        .domio-btn:hover {
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

                    <a
                        href="category-products.php?category=<?= urlencode($product['category']) ?>"
                        class="back-btn">

                        <i class="fas fa-arrow-left mr-2"></i>

                        Back to <?= $product['category']; ?>

                    </a>

                    <div class="row mt-4 align-items-stretch">

                        <div class="col-lg-4">

                            <div class="detail-card">

                                <img
                                    src="../<?= $product['image']; ?>"
                                    class="detail-image">

                            </div>

                        </div>

                        <div class="col-lg-8">

                            <div class="detail-card">

                                <span class="product-category">

                                    <?= $product['category']; ?>

                                </span>

                                <h1 class="product-name">

                                    <?= $product['name']; ?>

                                </h1>

                                <div class="product-price">

                                    $
                                    <?= number_format($product['price'], 2); ?>

                                </div>

                                <hr style="margin:30px 0;">

                                <h5
                                    style="
                                    color:#131010;
                                    font-weight:700;">

                                    Description

                                </h5>

                                <p class="product-description">

                                    <?= $product['description']; ?>

                                </p>

                                <a
                                    href="edit-product.php?id=<?= $product['id']; ?>"
                                    class="domio-btn">

                                    Edit Product

                                </a>

                            </div>

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