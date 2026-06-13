<?php

session_start();

require_once '../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $database = new Database();
    $db = $database->getConnection();

    $query = "
        SELECT *
        FROM admins
        WHERE email = ?
        LIMIT 1
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$email]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (
        $admin &&
        password_verify(
            $password,
            $admin['password']
        )
    ) {

        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['username'];
        $_SESSION['admin_email'] = $admin['email'];

        header("Location: dashboard.php");
        exit();
    }

    $error = "Invalid email or password";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Domio</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }
    </style>

</head>

<body>

    <div class="relative min-h-screen">

        <!-- BACKGROUND -->
        <img
            src="../assets/images/background/bg-home.svg"
            class="absolute inset-0 w-full h-full object-cover">

        <!-- OVERLAY -->
        <div
            class="absolute inset-0 bg-black/40">
        </div>

        <!-- CONTENT -->
        <div class="relative z-10 min-h-screen">

            <div
                class="max-w-7xl mx-auto
                    min-h-screen
                    flex items-center
                    justify-center
                    px-6">

                <!-- CARD LOGIN -->
                <div
                    class="w-full max-w-md
                            bg-white/95
                            backdrop-blur-sm
                            rounded-[32px]
                            shadow-2xl
                            p-10">

                    <!-- LOGO -->
                    <div class="text-center mb-8">

                        <img
                            src="../assets/logo.svg"
                            class="w-28 mx-auto mb-5">

                        <h1
                            class="text-3xl font-bold text-[#1E1E1E]">

                            Admin Login

                        </h1>

                        <p
                            class="text-gray-500 mt-2">

                            Welcome to Domio Dashboard

                        </p>

                    </div>

                    <!-- ERROR -->
                    <?php if ($error): ?>

                        <div
                            class="bg-red-100
                                    text-red-600
                                    p-4
                                    rounded-2xl
                                    mb-5">

                            <?= $error ?>

                        </div>

                    <?php endif; ?>

                    <!-- FORM -->
                    <form method="POST">

                        <!-- EMAIL -->
                        <div class="mb-5">

                            <label
                                class="text-sm
                                        font-medium
                                        text-[#543A14]">

                                Email Address

                            </label>

                            <input
                                type="email"
                                name="email"
                                required
                                class="w-full mt-2
                                        border border-[#D6CFC7]
                                        rounded-full
                                        px-5 py-3
                                        focus:outline-none
                                        focus:ring-2
                                        focus:ring-[#D9A86C]">

                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-6">

                            <label
                                class="text-sm
                                        font-medium
                                        text-[#543A14]">

                                Password

                            </label>

                            <div class="relative mt-2">

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    class="w-full
                                            border border-[#D6CFC7]
                                            rounded-full
                                            px-5 py-3
                                            pr-12
                                            focus:outline-none
                                            focus:ring-2
                                            focus:ring-[#D9A86C]">

                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute
                                            right-4
                                            top-1/2
                                            -translate-y-1/2">

                                    <img
                                        src="../assets/icons/eye.svg"
                                        class="w-5 h-5 opacity-70 hover:opacity-100">

                                </button>

                            </div>

                        </div>

                        <!-- BUTTON LOGIN -->
                        <button
                            type="submit"
                            class="w-full
                                    bg-black
                                    text-white
                                    py-3
                                    rounded-full
                                    font-medium
                                    hover:bg-[#FFF0DC]
                                    hover:text-[#543A14]
                                    transition-all duration-300">

                            Login

                        </button>

                        <!-- BACK WEBSITE -->
                        <div class="text-center mt-5">

                            <a
                                href="../index.php"
                                class="text-sm
                                        text-[#543A14]
                                        hover:underline">

                                ← Back to Website

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        function togglePassword() {

            const password =
                document.getElementById(
                    'password'
                );

            if (password.type === 'password') {

                password.type = 'text';

            } else {

                password.type = 'password';

            }

        }
    </script>

</body>

</html>