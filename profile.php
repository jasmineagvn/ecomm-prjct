<?php

include 'components/header.php';
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$userId = $_SESSION['user_id'];

$success = '';
$error = '';

/*
|--------------------------------------------------------------------------
| UPDATE PROFILE
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    if (
        empty($username) ||
        empty($email)
    ) {

        $error = 'All fields are required';
    } else {

        try {

            $query = "
                UPDATE users
                SET username = ?,
                    email = ?
                WHERE id = ?
            ";

            $stmt = $db->prepare($query);

            $stmt->execute([
                $username,
                $email,
                $userId
            ]);

            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            $success =
                'Profile updated successfully';
        } catch (PDOException $e) {

            $error =
                $e->getMessage();
        }
    }
}

/*
|--------------------------------------------------------------------------
| GET USER
|--------------------------------------------------------------------------
*/

$query = "
    SELECT *
    FROM users
    WHERE id = ?
";

$stmt = $db->prepare($query);

$stmt->execute([
    $userId
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<main>

    <!-- HERO -->
    <section class="relative h-[180px] overflow-hidden">

        <img
            src="assets/images/background/bg-details.svg"
            class="w-full h-full object-cover">

        <div class="absolute inset-0 flex items-center justify-center">

            <h1 class="text-white text-5xl font-bold">
                My Profile
            </h1>

        </div>

    </section>

    <!-- CONTENT -->
    <section class="max-w-3xl mx-auto px-6 py-12">

        <div
            class="bg-white rounded-3xl shadow-lg p-10">

            <div class="flex items-center gap-5 mb-10">

                <div class="w-20 h-20 rounded-full bg-[#F7E9D7]
                flex items-center justify-center">

                    <img
                        src="assets/icons/user.svg"
                        class="w-10 h-10">

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-[#1E1E1E]">
                        <?= htmlspecialchars($user['username']) ?>
                    </h2>

                    <p class="text-gray-500">
                        <?= htmlspecialchars($user['email']) ?>
                    </p>

                </div>

            </div>

            <h2
                class="text-2xl font-semibold mb-8">

                Profile Information

            </h2>

            <?php if ($error): ?>

                <div
                    class="bg-red-100 text-red-600 p-4 rounded-xl mb-6">

                    <?= $error ?>

                </div>

            <?php endif; ?>

            <?php if ($success): ?>

                <div
                    class="bg-green-100 text-green-600 p-4 rounded-xl mb-6">

                    <?= $success ?>

                </div>

            <?php endif; ?>

            <form method="POST">

                <!-- NAME -->
                <div class="mb-5">

                    <label
                        class="text-sm text-[#1E1E1E]">

                        Full Name

                    </label>

                    <input
                        type="text"
                        name="username"
                        value="<?= htmlspecialchars($user['username']) ?>"
                        class="w-full mt-2 border border-[#D6CFC7] rounded-full px-5 py-3">

                </div>

                <!-- EMAIL -->
                <div class="mb-8">

                    <label
                        class="text-sm text-[#1E1E1E]">

                        Email Address

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="<?= htmlspecialchars($user['email']) ?>"
                        class="w-full mt-2 border border-[#D6CFC7] rounded-full px-5 py-3">

                </div>

                <button
                    type="submit"
                    class="bg-black text-white
                            px-10 py-3
                            rounded-full
                            hover:bg-[#FFF0DC]
                            hover:text-[#543A14]
                            transition-all duration-300">

                    Save Changes

                </button>

                <hr class="my-10 border-[#F2F2F2]">

                <h2 class="text-2xl font-semibold mb-8">

                    Security Settings

                </h2>

                <p class="text-gray-500 mb-6">

                    Keep your account secure by updating your password regularly.

                </p>

                <a
                    href="forgot-password.php"
                    class="inline-block
                            bg-black text-white
                            px-8 py-3 rounded-full
                            hover:bg-[#FFF0DC]
                            hover:text-[#543A14]
                            transition-all duration-300">

                    Change Password

                </a>

            </form>

        </div>

    </section>

</main>

<?php include 'components/footer.php'; ?>