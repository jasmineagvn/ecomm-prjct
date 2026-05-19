<?php

require_once 'config/database.php';

$error = '';
$success = '';

if ($_POST) {

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

                // HASH PASSWORD
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // INSERT USER
                $query = "INSERT INTO users (username, email, password)
                          VALUES (?, ?, ?)";

                $stmt = $db->prepare($query);

                $stmt->execute([
                    $username,
                    $email,
                    $hashedPassword
                ]);

                $success = 'Account created successfully';

                // REDIRECT LOGIN
                header("refresh:2;url=login.php");

            }

        } catch(PDOException $e) {

            $error = 'Error: ' . $e->getMessage();

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Register - Domio</title>

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
  <div class="w-full max-w-6xl grid md:grid-cols-2 items-center gap-10">

    <!-- LEFT -->
    <div>

      <h2 class="text-2xl font-bold text-[#1E1E1E]">
        Create Account
      </h2>

      <p class="text-sm text-gray-500 mt-2">
        Enter your details to get started.
      </p>

      <!-- ERROR -->
      <?php if ($error): ?>
        <div class="bg-red-100 text-red-600 px-4 py-2 rounded mt-4 text-sm">
          <?= htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <!-- SUCCESS -->
      <?php if ($success): ?>
        <div class="bg-green-100 text-green-600 px-4 py-2 rounded mt-4 text-sm">
          <?= htmlspecialchars($success); ?>
        </div>
      <?php endif; ?>

      <!-- FORM -->
      <form method="POST" class="mt-6 space-y-5">

        <!-- FULL NAME -->
        <div>
          <label class="text-sm text-[#1E1E1E]">
            Full Name
          </label>

          <input 
            type="text"
            name="username"
            required
            placeholder="Enter Your Name"
            class="w-full mt-2 px-4 py-3 rounded-full border border-[#D6CFC7] bg-transparent focus:outline-none focus:border-[#A67C52]"
          >
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
            placeholder="Example123@gmail.com"
            class="w-full mt-2 px-4 py-3 rounded-full border border-[#D6CFC7] bg-transparent focus:outline-none focus:border-[#A67C52]"
          >
        </div>

        <!-- PASSWORD -->
        <div>

          <label class="text-sm text-[#1E1E1E]">
            Password
          </label>

          <div class="relative">

            <input 
              type="password"
              name="password"
              id="password"
              required
              placeholder="••••••••"
              class="w-full mt-2 px-4 py-3 rounded-full border border-[#D6CFC7] bg-transparent focus:outline-none focus:border-[#A67C52]"
            >

            <!-- TOGGLE -->
            <span onclick="togglePassword()"
              class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer">
              👁
            </span>

          </div>

        </div>

        <!-- TERMS -->
        <div class="flex items-center gap-2">

          <input 
            type="checkbox"
            required
            class="accent-[#6B4F2A]"
          >

          <p class="text-xs text-gray-500">
            I agree to the Terms & Conditions
          </p>

        </div>

        <!-- BUTTON -->
        <button 
          type="submit"
          class="w-full bg-black text-white py-3 rounded-full text-sm hover:opacity-90 transition"
        >
          Get Started
        </button>

      </form>

      <!-- LOGIN -->
      <p class="text-xs text-gray-500 mt-6 text-center">

        Already have an account?

        <a href="login.php" class="font-semibold text-black">
          Log In
        </a>

      </p>

    </div>

    <!-- RIGHT -->
    <div class="relative h-screen flex items-center justify-end overflow-hidden">

    <!-- TEXT -->
    <div class="absolute top-14 right-20 text-center max-w-sm z-10">

        <h2 class="text-4xl font-bold text-[#6B4F2A] leading-tight">
        Your Modern Home <br>
        Starts Here.
        </h2>

        <p class="text-sm text-gray-500 mt-3 leading-relaxed">
        Set up your profile to enjoy seamless shopping <br>and easy order management <br>for your living space.
        </p>

    </div>

    <!-- IMAGE -->
    <img 
        src="assets/images/background/bg-login.png" 
        alt="Chair"
        class="absolute right-[-20px] bottom-0 w-[520px] md:w-[620px] object-contain"
    >

    </div>

  </div>

</div>

<!-- SCRIPT -->
<script>

function togglePassword() {

  const input = document.getElementById("password");

  input.type =
    input.type === "password"
      ? "text"
      : "password";

}

</script>

</body>
</html>