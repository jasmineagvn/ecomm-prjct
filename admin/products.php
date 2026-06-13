<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$categories = [

    [
        'name' => 'Living Room',
        'image' => '../assets/images/categories/cat-1.svg'
    ],

    [
        'name' => 'Dining',
        'image' => '../assets/images/categories/dining.svg'
    ],

    [
        'name' => 'Bedroom',
        'image' => '../assets/images/categories/bedroom.svg'
    ],

    [
        'name' => 'Workspace',
        'image' => '../assets/images/categories/workspace.svg'
    ]

];

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Products - Domio Admin</title>

    <link
        href="vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet">

    <link
        href="css/sb-admin-2.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #ffffff;
        }

        .page-title {
            font-size: 34px;
            font-weight: 700;
            color: #543A14;
        }

        .page-subtitle {
            color: #8B7355;
            margin-top: 5px;
        }

        .category-card {

            position: relative;
            overflow: hidden;

            border-radius: 24px;

            height: 260px;

            transition: .3s;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, .08);
        }

        .category-card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 15px 35px rgba(0, 0, 0, .12);
        }

        .category-card img {

            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-overlay {

            position: absolute;

            inset: 0;

            background:
                linear-gradient(to top,
                    rgba(0, 0, 0, .65),
                    rgba(0, 0, 0, .15));

            display: flex;

            flex-direction: column;

            justify-content: flex-end;

            padding: 25px;
        }

        .category-title {

            color: white;

            font-size: 28px;

            font-weight: 700;
        }

        .category-count {

            color: white;

            opacity: .9;
        }

        a:hover {
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

                        Furniture Collections

                    </h1>

                    <p class="page-subtitle">

                        Choose a category to manage products

                    </p>

                    <div class="row mt-4">

                        <?php foreach ($categories as $category): ?>

                            <?php

                            $stmt = $db->prepare(
                                "SELECT COUNT(*) FROM products
                         WHERE category = ?"
                            );

                            $stmt->execute([
                                $category['name']
                            ]);

                            $totalProducts =
                                $stmt->fetchColumn();

                            ?>

                            <div class="col-lg-6 mb-4">

                                <a
                                    href="category-products.php?category=<?= urlencode($category['name']); ?>">

                                    <div class="category-card">

                                        <img
                                            src="<?= $category['image']; ?>">

                                        <div class="category-overlay">

                                            <div class="category-title">

                                                <?= $category['name']; ?>

                                            </div>

                                            <div class="category-count">

                                                <?= $totalProducts; ?>
                                                Products

                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        <?php endforeach; ?>

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