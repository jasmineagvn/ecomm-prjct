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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    $imagePath = $product['image'];

    if (!empty($_FILES['image']['name'])) {

        $uploadDir =
            '../assets/images/shop/uploads/';

        $fileName =
            time() .
            '-' .
            basename($_FILES['image']['name']);

        $targetFile =
            $uploadDir .
            $fileName;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $targetFile
        );

        $imagePath =
            'assets/images/shop/uploads/' .
            $fileName;
    }

    $stmt = $db->prepare("
        UPDATE products
        SET
            name = ?,
            price = ?,
            description = ?,
            image = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $name,
        $price,
        $description,
        $imagePath,
        $id
    ]);

    header(
        'Location: category-products.php?category=' .
            urlencode($product['category'])
    );

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

    <title>Add Product</title>

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
            color: #543A14;
            font-size: 34px;
            font-weight: 700;
        }

        .page-subtitle {
            color: #8B7355;
        }

        .domio-card {
            background: #fff;
            border-radius: 24px;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, .05);
            padding: 30px;
        }

        .form-control,
        .form-select {
            height: 52px;
            border-radius: 14px;
            border: 1px solid #E5E5E5;
        }

        textarea.form-control {
            height: 140px;
        }

        .domio-btn {
            background: #131010;
            color: white !important;
            border: none;
            border-radius: 999px;
            padding: 12px 25px;
        }

        .domio-btn:hover {
            background: #543A14;
        }

        .domio-btn-outline {
            border: 1px solid #D7C6B2;
            color: #543A14;
            border-radius: 999px;
            padding: 12px 25px;
            background: white;
        }

        .back-btn {
            color: #8B7355;
            font-weight: 500;
            transition: .3s;
        }

        .back-btn:hover {
            color: #131010;
            text-decoration: none;
        }

        .domio-card {
            border: none;
            background: #fff;
            border-radius: 28px;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, .04);
        }

        .preview-box {
            width: 100%;
            height: 250px;
            border: 2px dashed #DDD;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .category-dropdown {
            width: 100%;
            height: 55px;
            padding: 0 20px;
            border: 1px solid #E5E5E5;
            border-radius: 16px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #555;
            transition: .3s;
        }

        .category-dropdown:hover {
            border-color: #D7C6B2;
        }

        .category-menu {
            width: 100%;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, .08);
        }

        .category-menu {
            display: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 100%;
            background: #fff;
            z-index: 9999;
        }

        .category-menu.show {
            display: block;
        }

        .category-item {
            padding: 12px 20px;
        }

        .category-item:hover {
            background: #FFF8F0;
            color: #543A14;
        }

        .form-control,
        .custom-select {
            height: 55px;
            border-radius: 16px;
            border: 1px solid #E5E5E5;
            box-shadow: none;
        }

        .category-readonly {
            background: #F8F5F0 !important;
            color: #543A14 !important;
            font-weight: 600;
            cursor: not-allowed;
            border: 1px solid #E5E5E5;
        }

        .custom-select:focus {
            border-color: #D8C3A5;
            box-shadow: none;
        }

        .custom-select {
            padding-left: 20px;
            padding-right: 45px;
            background-position:
                right 18px center;
        }

        .btn-cancel {
            background: #FBEAEA;
            color: #B85C5C !important;
            border: none;
            border-radius: 999px;
            padding: 12px 25px;
            transition: .3s;
        }

        .btn-cancel:hover {
            background: #E8CFCF;
            color: #8E3E3E !important;
        }

        .upload-area {
            text-align: center;
            margin-top: 20px;
        }

        .upload-btn {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 14px;
            background: #131010;
            color: #fff;
            transition: .3s;
        }

        .upload-btn:hover {
            background: #543A14;
        }

        .upload-text {
            margin-top: 12px;
            color: #8B7355;
            font-size: 14px;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <?php include '../components/sidebar.php'; ?>

        <div id="content-wrapper">

            <div id="content">

                <div class="container-fluid px-4 py-4">

                    <a
                        href="javascript:history.back()"
                        class="back-btn">

                        <i class="fas fa-arrow-left mr-2"></i>

                        Back to Products

                    </a>

                    <h1 class="page-title mt-3">

                        Edit Product

                    </h1>

                    <p class="page-subtitle">

                        Update furniture information

                    </p>

                    <form
                        method="POST"
                        enctype="multipart/form-data">

                        <div class="row">

                            <!-- LEFT -->

                            <div class="col-lg-8">

                                <div class="domio-card mb-4">

                                    <h5 class="mb-4">

                                        Product Information

                                    </h5>

                                    <div class="form-group">

                                        <label>

                                            Product Name

                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            required
                                            class="form-control"
                                            value="<?= htmlspecialchars($product['name']) ?>">

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label>
                                                    Category
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control category-readonly"
                                                    value="<?= htmlspecialchars($product['category']) ?>"
                                                    readonly>

                                                <input
                                                    type="hidden"
                                                    name="category"
                                                    value="<?= htmlspecialchars($product['category']) ?>">

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label>
                                                    Price (Rp)
                                                </label>

                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    name="price"
                                                    required
                                                    class="form-control"
                                                    value="<?= $product['price'] ?>">

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label>

                                            Description

                                        </label>

                                        <textarea
                                            name="description"
                                            required
                                            class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>

                                    </div>

                                    <div style="margin-top:25px;">

                                        <a
                                            href="javascript:history.back()"
                                            class="btn btn-cancel mr-2">

                                            Cancel

                                        </a>

                                        <button
                                            type="submit"
                                            class="btn domio-btn mt-4">

                                            Update Product

                                        </button>

                                    </div>

                                </div>

                            </div>

                            <!-- RIGHT -->

                            <div class="col-lg-4">

                                <div class="domio-card">

                                    <h5 class="mb-4">

                                        Product Image

                                    </h5>

                                    <div
                                        class="preview-box mb-3">

                                        <img
                                            id="preview"
                                            src="../<?= $product['image']; ?>"
                                            style="
                                                width:100%;
                                                height:100%;
                                                object-fit:cover;
                                                display:block;
                                            ">

                                    </div>

                                    <div class="upload-area">

                                        <button
                                            type="button"
                                            class="upload-btn"
                                            onclick="document.getElementById('imageInput').click()">

                                            <i class="fas fa-upload mr-2"></i>
                                            Upload Product Image

                                        </button>

                                        <p
                                            id="fileName"
                                            class="upload-text">

                                            Current product image

                                        </p>

                                    </div>

                                    <input
                                        type="file"
                                        id="imageInput"
                                        name="image"
                                        accept="image/*"
                                        hidden
                                        onchange="previewImage(event)">

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        function previewImage(event) {

            const file =
                event.target.files[0];

            if (file) {

                document.getElementById(
                        'fileName'
                    ).innerText =
                    file.name;

                const reader =
                    new FileReader();

                reader.onload =
                    function(e) {

                        document
                            .getElementById(
                                'preview'
                            ).src =
                            e.target.result;

                        document
                            .getElementById(
                                'preview'
                            ).style.display =
                            'block';
                    };

                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</html>