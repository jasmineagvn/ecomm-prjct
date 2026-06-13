<?php

session_start();

if (isset($_SESSION['user_logged_in'])) {
  header("Location: index.php");
  exit();
}

require_once 'config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (
    empty($username) ||
    empty($email) ||
    empty($password)
  ) {

    $error = 'All fields are required';
  } else {

    try {

      $database = new Database();
      $db = $database->getConnection();

      // CHECK EMAIL
      $checkQuery = "SELECT id FROM users WHERE email = ?";
      $checkStmt = $db->prepare($checkQuery);
      $checkStmt->execute([$email]);

      if ($checkStmt->rowCount() > 0) {

        $error = 'Email already registered';
      } else {

        $hashedPassword = password_hash(
          $password,
          PASSWORD_DEFAULT
        );

        $query = "
                    INSERT INTO users
                    (
                        username,
                        email,
                        password
                    )
                    VALUES
                    (
                        ?,
                        ?,
                        ?
                    )
                ";

        $stmt = $db->prepare($query);

        $stmt->execute([
          $username,
          $email,
          $hashedPassword
        ]);

        $_SESSION['register_success'] = true;

        header("Location: login.php");
        exit();
      }
    } catch (PDOException $e) {

      $error = $e->getMessage();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Create Account - Domio</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Manrope', sans-serif;
    }
  </style>

</head>

<body class="bg-white">

  <div class="min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-7xl grid md:grid-cols-2 items-center gap-4">

      <!-- LEFT -->
      <div>

        <h2 class="text-2xl font-semibold text-[#1E1E1E]">
          Create Account
        </h2>

        <p class="text-sm text-gray-500 mt-2">
          Enter your details to get started.
        </p>

        <?php if ($error): ?>
          <div class="bg-red-100 text-red-600 px-4 py-3 rounded-lg mt-4">
            <?= htmlspecialchars($error); ?>
          </div>
        <?php endif; ?>

        <form method="POST" class="mt-6 space-y-5">

          <!-- NAME -->
          <div>

            <label class="text-sm text-[#1E1E1E]">
              Full Name
            </label>

            <input
              type="text"
              name="username"
              required
              value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
              placeholder="Enter Your Name"
              class="w-full max-w-[600px] mt-2 px-4 py-3 rounded-full border border-[#D6CFC7] focus:outline-none focus:border-[#543A14]">

          </div>

          <!-- EMAIL -->
          <div>

            <label class="text-sm text-[#1E1E1E]">
              Email Address
            </label>

            <input
              type="email"
              name="email"
              required
              value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
              placeholder="example@gmail.com"
              class="w-full max-w-[600px] mt-2 px-4 py-3 rounded-full border border-[#D6CFC7] focus:outline-none focus:border-[#543A14]">

          </div>

          <!-- PASSWORD -->
          <div>

            <label class="text-sm text-[#1E1E1E]">
              Password
            </label>

            <div class="relative max-w-[600px] mt-2">

              <input
                type="password"
                name="password"
                id="password"
                required
                placeholder="••••••••"
                class="w-full px-4 py-3 rounded-full border border-[#D6CFC7] pr-12 focus:outline-none focus:border-[#543A14]">

              <button
                type="button"
                onclick="togglePassword()"
                class="absolute right-4 top-1/2 -translate-y-1/2">

                <img
                  src="./assets/icons/eye.svg"
                  alt="eye"
                  class="w-5 h-5 opacity-60 hover:opacity-100">

              </button>

            </div>

          </div>

          <!-- TERMS -->
          <div class="flex items-center gap-2">

            <input
              type="checkbox"
              required
              class="accent-[#543A14]">

            <p class="text-xs text-gray-500">
              I agree to the Terms & Conditions
            </p>

          </div>

          <!-- BUTTON -->
          <button
            type="submit"
            class="w-full max-w-[600px] bg-black text-white py-3 rounded-full hover:opacity-90 transition">

            Get Started

          </button>

        </form>

        <p class="text-xs text-gray-500 mt-6 text-center">

          Already have an account?

          <a
            href="login.php"
            class="font-semibold text-black">

            Log In

          </a>

        </p>

      </div>

      <!-- RIGHT -->
      <div class="relative min-h-screen flex items-center justify-center">

        <div class="absolute top-28 right-16 text-right max-w-sm z-10">

          <h2 class="text-4xl font-semibold text-[#6B4F2A]">
            Your Modern Home Starts Here.
          </h2>

          <p class="text-sm text-gray-500 mt-3 leading-relaxed">
            Set up your profile to enjoy seamless shopping and easy order management for your living space.
          </p>

        </div>

        <img
          src="assets/images/background/bg-login.svg"
          alt="Chair"
          class="w-full max-w-[700px] object-contain -mt-40">

      </div>

    </div>

  </div>

  <script>
    function togglePassword() {

      const input = document.getElementById("password");

      input.type =
        input.type === "password" ?
        "text" :
        "password";

    }
  </script>

</body>

</html>