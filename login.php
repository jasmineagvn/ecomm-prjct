<?php
require_once __DIR__ . '/classes/Auth.php';

$auth = new Auth();

// Redirect kalau sudah login
if ($auth->isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_POST) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Email dan password harus diisi';
    } else {
        $result = $auth->login($username, $password);
        
        if ($result['success']) {
            header("Location: " . $result['redirect']);
            exit();
        } else {
            $error = $result['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Domio</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
  body {
    font-family: 'Manrope', sans-serif;
  }
</style>
</head>

<body class="bg-[#F9F6F2]">

<div class="min-h-screen flex items-center justify-center px-6">

  <!-- CONTAINER -->
  <div class="w-full max-w-6xl grid md:grid-cols-2 items-center gap-10">

    <!-- LEFT SIDE (FORM) -->
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
            type="text" 
            name="username"
            required
            value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
            placeholder="Example123@gmail.com"
            class="w-full mt-2 px-4 py-3 rounded-full border border-[#D6CFC7] bg-transparent focus:outline-none focus:border-[#A67C52]"
          >
        </div>

        <!-- PASSWORD -->
        <div>
          <label class="text-sm text-[#1E1E1E]">Password</label>

          <div class="relative">
            <input 
              type="password" 
              name="password"
              required
              placeholder="••••••••"
              class="w-full mt-2 px-4 py-3 rounded-full border border-[#D6CFC7] bg-transparent focus:outline-none focus:border-[#A67C52]"
            >

            <!-- ICON (optional mata) -->
            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer">
              👁
            </span>
          </div>

          <p class="text-xs text-gray-400 mt-2 cursor-pointer hover:underline">
            Forgot Password?
          </p>
        </div>

        <!-- BUTTON -->
        <button 
          type="submit"
          class="w-full bg-black text-white py-3 rounded-full text-sm hover:opacity-90 transition"
        >
          Log In
        </button>

      </form>

      <!-- REGISTER -->
      <p class="text-xs text-gray-500 mt-6 text-center">
        Don’t have an account? 
        <a href="register.php" class="font-semibold text-black">
          Create Account
        </a>
      </p>

    </div>


    <!-- RIGHT SIDE -->
    <div class="relative flex items-center justify-center">

      <!-- TEXT -->
      <div class="absolute top-0 right-0 text-right max-w-sm">
        <h2 class="text-3xl font-semibold text-[#6B4F2A]">
          Welcome Back!
        </h2>

        <p class="text-sm text-gray-500 mt-2">
          Sign in to access your shipping details and view your recent furniture orders.
        </p>
      </div>

      <!-- IMAGE -->
      <img 
        src="assets/images/login-chair.png" 
        alt="Chair"
        class="w-[350px] md:w-[420px] mt-20"
      >

    </div>

  </div>

</div>

</body>
</html>