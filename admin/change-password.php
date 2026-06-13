<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$id = $_SESSION['admin_id'];

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $stmt = $db->prepare("
        SELECT *
        FROM admins
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify(
        $currentPassword,
        $admin['password']
    )) {

        $error = "Current password is incorrect.";
    } elseif ($newPassword !== $confirmPassword) {

        $error = "Password confirmation does not match.";
    } else {

        $hashedPassword = password_hash(
            $newPassword,
            PASSWORD_DEFAULT
        );

        $update = $db->prepare("
            UPDATE admins
            SET password = ?
            WHERE id = ?
        ");

        $update->execute([
            $hashedPassword,
            $id
        ]);

        $message = "Password updated successfully.";
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Change Password</title>

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
            transition: .3s;
        }

        .back-btn:hover {
            color: #131010;
            text-decoration: none;
        }

        .domio-card {
            background: #fff;
            border-radius: 28px;
            padding: 35px;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, .05);
            width: 100%;
            max-width: 550px;
            margin: auto;
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

        .btn-save {
            width: 100%;
            height: 55px;
            background: #131010;
            color: #fff !important;
            border: none;
            border-radius: 999px;
            transition: .3s;
        }

        .btn-save:hover {
            background: #543A14;
        }

        .password-icon {
            color: #543A14;
            font-size: 42px;
            margin-bottom: 10px;
        }

        .security-title {
            font-size: 28px;
            color: #131010;
            font-weight: 600;
        }

        .security-subtitle {
            font-size: 15px;
            color: #8B7355;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <?php include '../components/sidebar.php'; ?>

        <div id="content-wrapper">

            <div id="content">

                <div class="container-fluid px-4 py-4">

                    <!-- HEADER -->
                    <a href="profile.php" class="back-btn">

                        <i class="fas fa-arrow-left mr-2"></i>

                        Back

                    </a>

                    <h1 class="page-title mt-3">

                        Change Password

                    </h1>

                    <p class="page-subtitle">

                        Update administrator password

                    </p>

                    <div class="domio-card">

                        <div class="text-center mb-4">

                            <i class="fas fa-lock password-icon"></i>

                            <h4 class="security-title">

                                Security Settings

                            </h4>

                            <p class="security-subtitle mb-0">

                                Keep your administrator account secure

                            </p>

                        </div>

                        <?php if ($message): ?>

                            <div class="alert alert-success">

                                <?= $message; ?>

                            </div>

                        <?php endif; ?>

                        <?php if ($error): ?>

                            <div class="alert alert-danger">

                                <?= $error; ?>

                            </div>

                        <?php endif; ?>

                        <form method="POST">

                            <div class="form-group">

                                <label>

                                    Current Password

                                </label>

                                <input
                                    type="password"
                                    name="current_password"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="form-group">

                                <label>

                                    New Password

                                </label>

                                <input
                                    type="password"
                                    name="new_password"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="form-group">

                                <label>

                                    Confirm Password

                                </label>

                                <input
                                    type="password"
                                    name="confirm_password"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="text-center mt-4">

                                <button
                                    type="submit"
                                    class="btn-save">

                                    Update Password

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>