<?php

/*
|--------------------------------------------------------------------------
| KONEKSI DATABASE
|--------------------------------------------------------------------------
*/

require_once 'config/database.php';

$error = '';
$success = '';

/*
|--------------------------------------------------------------------------
| PROSES RESET PASSWORD
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    /*
    |--------------------------------------------------------------------------
    | VALIDASI FORM
    |--------------------------------------------------------------------------
    */

    if (
        empty($email) ||
        empty($password) ||
        empty($confirmPassword)
    ) {

        $error = 'All fields are required';
    } elseif ($password !== $confirmPassword) {

        $error = 'Password confirmation does not match';
    } else {

        try {

            $database = new Database();
            $db = $database->getConnection();

            /*
            |--------------------------------------------------------------------------
            | CEK EMAIL
            |--------------------------------------------------------------------------
            */

            $query = "
                SELECT id
                FROM users
                WHERE email = ?
            ";

            $stmt = $db->prepare($query);
            $stmt->execute([$email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {

                $error = 'Email not found';
            } else {

                /*
                |--------------------------------------------------------------------------
                | HASH PASSWORD BARU
                |--------------------------------------------------------------------------
                */

                $hashedPassword = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                /*
                |--------------------------------------------------------------------------
                | UPDATE PASSWORD
                |--------------------------------------------------------------------------
                */

                $query = "
                    UPDATE users
                    SET password = ?
                    WHERE email = ?
                ";

                $stmt = $db->prepare($query);

                $stmt->execute([
                    $hashedPassword,
                    $email
                ]);

                $success = 'Password updated successfully';

                /*
                |--------------------------------------------------------------------------
                | REDIRECT KE LOGIN
                |--------------------------------------------------------------------------
                */

                header("refresh:2;url=login.php");
            }
        } catch (PDOException $e) {

            $error = 'Error : ' . $e->getMessage();
        }
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

    <title>
        Forgot Password - Domio
    </title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FONT -->
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }
    </style>

</head>

<body class="bg-white">

    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-md">

            <!-- TITLE -->
            <h1 class="text-3xl font-bold text-[#1E1E1E] mb-2">

                Forgot Password

            </h1>

            <p class="text-gray-500 mb-8">

                Enter your email and create a new password.

            </p>

            <!-- ERROR -->
            <?php if ($error): ?>

                <div
                    class="bg-red-100 text-red-600 p-4 rounded-xl mb-5">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>

            <!-- SUCCESS -->
            <?php if ($success): ?>

                <div
                    class="bg-green-100 text-green-600 p-4 rounded-xl mb-5">

                    <?= htmlspecialchars($success) ?>

                </div>

            <?php endif; ?>

            <!-- FORM -->
            <form
                method="POST"
                class="space-y-5">

                <!-- EMAIL -->
                <div>

                    <label class="text-sm text-[#1E1E1E]">

                        Email Address

                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="example@gmail.com"
                        class="w-full mt-2 border border-[#D6CFC7] rounded-full px-5 py-3">

                </div>

                <!-- NEW PASSWORD -->
                <div>

                    <label class="text-sm text-[#1E1E1E]">
                        New Password
                    </label>

                    <div class="relative mt-2">

                        <input
                            type="password"
                            id="newPassword"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full border border-[#D6CFC7] rounded-full px-5 py-3 pr-12">

                        <button
                            type="button"
                            onclick="toggleNewPassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2">

                            <img
                                src="assets/icons/eye.svg"
                                alt="eye"
                                class="w-5 h-5 opacity-60 hover:opacity-100">

                        </button>

                    </div>

                </div>

                <!-- CONFIRM PASSWORD -->
                <div>

                    <label class="text-sm text-[#1E1E1E]">
                        Confirm Password
                    </label>

                    <div class="relative mt-2">

                        <input
                            type="password"
                            id="confirmPassword"
                            name="confirm_password"
                            required
                            placeholder="••••••••"
                            class="w-full border border-[#D6CFC7] rounded-full px-5 py-3 pr-12">

                        <button
                            type="button"
                            onclick="toggleConfirmPassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2">

                            <img
                                src="assets/icons/eye.svg"
                                alt="eye"
                                class="w-5 h-5 opacity-60 hover:opacity-100">

                        </button>

                    </div>

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full
                        bg-black
                        text-white
                        py-3
                        rounded-full
                        hover:bg-[#FFF0DC]
                        hover:text-[#543A14]
                        transition-all duration-300">

                    Reset Password

                </button>

            </form>

            <!-- BACK -->
            <div class="text-center mt-6">

                <a
                    href="login.php"
                    class="text-[#543A14] hover:underline">

                    Back to Login

                </a>

            </div>

        </div>

    </div>

    <script>
        function toggleNewPassword() {

            const input =
                document.getElementById(
                    'newPassword'
                );

            input.type =
                input.type === 'password' ?
                'text' :
                'password';
        }

        function toggleConfirmPassword() {

            const input =
                document.getElementById(
                    'confirmPassword'
                );

            input.type =
                input.type === 'password' ?
                'text' :
                'password';
        }
    </script>

</body>

</html>