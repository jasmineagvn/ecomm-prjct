<?php

require_once 'classes/Auth.php';

$auth = new Auth();

/*
|--------------------------------------------------------------------------
| SUDAH LOGIN?
|--------------------------------------------------------------------------
*/

if ($auth->isLoggedIn()) {

  header("Location: index.php");
  exit();
}

$error = '';

/*
|--------------------------------------------------------------------------
| PROSES LOGIN
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {

    $error = 'Email dan password harus diisi';
  } else {

    $result = $auth->login(
      $email,
      $password
    );

    if ($result['success']) {

      header("Location: " . $result['redirect']);
      exit();
    }

    $error = $result['message'];
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Domio</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Manrope', sans-serif;
    }
  </style>
</head>

<body class="bg-[#FFFFFF]">

  <div class="min-h-screen flex items-center justify-center px-6">

    <!-- CONTAINER -->
    <div class="w-full max-w-7xl grid md:grid-cols-2 items-center gap-4">

      <!-- LEFT -->
      <div>

        <h2 class="text-2xl font-semibold text-[#1E1E1E]">
          Log In
        </h2>

        <p class="text-sm text-gray-500 mt-2">
          Enter your email and password to continue.
        </p>

        <!-- ERROR -->
        <?php if ($error): ?>
          <div class="bg-red-100 text-red-600 px-4 py-2 rounded mt-4 text-sm">
            <?= htmlspecialchars($error); ?>
          </div>
        <?php endif; ?>

        <!-- FORM -->
        <form method="POST" class="mt-6 space-y-5">

          <!-- EMAIL -->
          <div>
            <label class="text-sm text-[#1E1E1E]">Email Address</label>
            <input
              type="email"
              name="email"
              required
              value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
              placeholder="Example123@gmail.com"
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
                class="w-full px-4 py-3 rounded-full border border-[#D6CFC7] pr-12">

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

            <a
              href="forgot-password.php"
              class="inline-block text-xs text-[#8B7355] hover:text-[#543A14] mt-4 hover:underline">

              Forgot Password?

            </a>

          </div>

          <!-- BUTTON -->
          <div class="max-w-[600px]">
            <button
              type="submit"
              class="w-full bg-black text-white py-3 rounded-full hover:opacity-90 transition">
              Log In
            </button>
          </div>

        </form>

        <!-- REGISTER -->
        <p class="text-xs text-gray-500 mt-6 text-center">
          Don’t have an account?
          <a href="register.php" class="font-semibold text-black">
            Create Account
          </a>
        </p>

      </div>

      <!-- RIGHT -->
      <div class="relative min-h-screen flex items-center justify-center">

        <!-- TEXT -->
        <div class="absolute top-28 right-16 text-right max-w-sm z-10">
          <h2 class="text-4xl font-semibold text-[#6B4F2A]">
            Welcome Back!
          </h2>

          <p class="text-sm text-gray-500 mt-3 leading-relaxed">
            Sign in to access your shipping details and view your recent furniture orders.
          </p>
        </div>

        <!-- IMAGE -->
        <img
          src="assets/images/background/bg-login.svg"
          alt="Chair"
          class="w-full max-w-[750px] object-contain -mt-32">

      </div>
    </div>

  </div>

  <!-- SCRIPT -->
  <script>
    function togglePassword() {
      const input = document.getElementById("password");
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>

</body>

</html>