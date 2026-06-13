<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$id = $_SESSION['admin_id'];

$stmt = $db->prepare("
    SELECT *
    FROM admins
    WHERE id = ?
");

$stmt->execute([$id]);

$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];

    $email = $_POST['email'];

    $update = $db->prepare("
        UPDATE admins
        SET
            username = ?,
            email = ?
        WHERE id = ?
    ");

    $update->execute([
        $username,
        $email,
        $id
    ]);

    $_SESSION['admin_name'] = $username;

    header("Location: profile.php?success=1");

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

    <title>My Profile</title>

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
            font-size: 38px;
            font-weight: 700;
        }

        .page-subtitle {
            color: #8B7355;
            margin-bottom: 30px;
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
            background: #fff;
            border-radius: 28px;
            padding: 30px;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, .05);
            height: 100%;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            height: 55px;
            border-radius: 16px;
            border: 1px solid #E5E5E5;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: #D8C3A5;
        }

        .readonly-input {
            background: #F8F5F0 !important;
            color: #543A14 !important;
            font-weight: 600;
        }

        .admin-avatar {

            width: 130px;
            height: 130px;

            border-radius: 50%;

            background: #FFF0DC;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 25px;
        }

        .admin-avatar i {

            font-size: 55px;
            color: #543A14;
        }

        .admin-name {

            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #131010;
        }

        .admin-role {

            text-align: center;
            color: #8B7355;
            margin-bottom: 25px;
        }

        .btn-save {

            background: #131010;
            color: white !important;

            border: none;

            border-radius: 999px;

            padding: 12px 30px;

            transition: .3s;
        }

        .btn-save:hover {

            background: #543A14;
        }

        .alert-success {

            border-radius: 18px;
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
                        href="dashboard.php"
                        class="back-btn">

                        <i class="fas fa-arrow-left mr-2"></i>

                        Back

                    </a>

                    <h1 class="page-title mt-3">

                        My Profile

                    </h1>

                    <p class="page-subtitle">

                        Manage administrator account

                    </p>

                    <?php if (isset($_GET['success'])): ?>

                        <div class="alert alert-success">

                            Profile updated successfully.

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="row">

                            <!-- LEFT -->

                            <div class="col-lg-8">

                                <div class="domio-card">

                                    <h4 class="mb-4">

                                        Account Information

                                    </h4>

                                    <label>Username</label>

                                    <input
                                        type="text"
                                        name="username"
                                        class="form-control"
                                        value="<?= htmlspecialchars($admin['username']); ?>">

                                    <div class="form-group">

                                        <label>

                                            Email

                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            value="<?= htmlspecialchars($admin['email']); ?>">

                                    </div>

                                    <div class="form-group mb-4">

                                        <label>

                                            Role

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control readonly-input"
                                            value="Administrator"
                                            readonly>

                                    </div>

                                    <button
                                        type="submit"
                                        class="btn-save">

                                        Save Changes

                                    </button>

                                </div>

                            </div>

                            <!-- RIGHT -->

                            <div class="col-lg-4">

                                <div class="domio-card">

                                    <div class="admin-avatar">

                                        <i class="fas fa-user"></i>

                                    </div>

                                    <div class="admin-name">

                                        <?= htmlspecialchars($admin['username']); ?>

                                    </div>

                                    <div class="admin-role">

                                        Administrator
                                    </div>

                                    <hr>

                                    <div class="mt-3">

                                        <p>

                                            <strong>Email</strong>

                                        </p>

                                        <p>

                                            <?= htmlspecialchars($admin['email']); ?>

                                        </p>

                                        <p>

                                            <strong>Username</strong>

                                        </p>

                                        <p>

                                            <?= htmlspecialchars($admin['username']); ?>

                                        </p>

                                    </div>

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

</body>

</html>