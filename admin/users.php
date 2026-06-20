<?php

require_once 'classes/AdminAuth.php';

$auth = new AdminAuth();
$auth->requireLogin();

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$stmt = $db->query("
    SELECT *
    FROM users
    ORDER BY created_at DESC
");

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Users</title>

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
            font-size: 42px;
            font-weight: 700;
            color: #543A14;
        }

        .page-subtitle {
            color: #8B7355;
        }

        .users-card {
            background: #fff;
            border-radius: 24px;
            padding: 25px;
            box-shadow:
                0 10px 25px rgba(0,0,0,.05);
        }

        .search-box {
            width: 350px;
            border: none;
            outline: none;
            background: #F8F5F0;
            border-radius: 999px;
            padding: 12px 20px;
        }

        .user-table {
            width: 100%;
        }

        .user-table thead th {
            border: none;
            color: #8B7355;
            font-weight: 600;
            padding: 18px;
        }

        .user-table tbody td {
            padding: 20px 18px;
            border-top: 1px solid #F2F2F2;
            vertical-align: middle;
        }

        .user-row:hover {
            background: #FAFAFA;
        }

        .btn-view {
            background: #131010;
            color: white !important;
            padding: 10px 18px;
            border-radius: 999px;
            text-decoration: none;
            transition: .3s;
        }

        .btn-view:hover {
            background: #543A14;
            text-decoration: none;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #543A14;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
    </style>

</head>

<body id="page-top">

<div id="wrapper">

    <?php include '../components/sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <div class="container-fluid px-4 py-4">

                <h1 class="page-title">
                    Users
                </h1>

                <p class="page-subtitle">
                    View registered customer accounts
                </p>

                <?php if(isset($_GET['deleted'])): ?>

                <div
                    style="
                    background:#E8F8EC;
                    color:#1E9B4B;
                    padding:15px 20px;
                    border-radius:16px;
                    margin-top:20px;
                    margin-bottom:20px;
                    font-weight:600;
                    ">

                    ✅ User berhasil dihapus

                </div>

                <?php endif; ?>

                <div class="users-card mt-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h5 class="mb-0">
                            All Users
                        </h5>

                        <input
                            type="text"
                            id="searchUser"
                            class="search-box"
                            placeholder="Search user...">

                    </div>

                    <div class="table-responsive">

                        <table class="table user-table">

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Joined</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="userTable">

                                <?php foreach ($users as $user): ?>

                                <tr class="user-row">

                                    <td>
                                        #<?= $user['id']; ?>
                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="user-avatar mr-3">
                                                <?= strtoupper(substr($user['username'],0,1)); ?>
                                            </div>

                                            <strong>
                                                <?= htmlspecialchars($user['username']); ?>
                                            </strong>

                                        </div>

                                    </td>

                                    <td>
                                        <?= htmlspecialchars($user['email']); ?>
                                    </td>

                                    <td>
                                        <?= date(
                                            'd M Y',
                                            strtotime($user['created_at'])
                                        ); ?>
                                    </td>

                                    <td>

                                        <a
                                            href="users-detail.php?id=<?= $user['id']; ?>"
                                            class="btn-view">

                                            View

                                        </a>

                                    </td>

                                </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

const searchInput =
document.getElementById('searchUser');

searchInput.addEventListener(
'keyup',
function(){

    let value =
    this.value.toLowerCase();

    let rows =
    document.querySelectorAll(
    '#userTable tr'
    );

    rows.forEach(row=>{

        row.style.display =
        row.innerText
        .toLowerCase()
        .includes(value)
        ? ''
        : 'none';

    });

});

</script>

<script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/sb-admin-2.min.js"></script>

</body>
</html>