<?php

$currentPage = basename($_SERVER['PHP_SELF']);

function activeMenu($pages)
{
    global $currentPage;

    return in_array($currentPage, $pages)
        ? 'active-domio'
        : '';
}
?>

<style>
    .sidebar {
        width: 280px !important;
    }

    .sidebar .nav-item .nav-link {
        width: 100%;
    }

    .sidebar.toggled {
        width: 90px !important;
    }

    .active-domio {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 12px;
        margin: 0 12px;
    }

    .active-domio .nav-link {
        color: #FFF0DC !important;
        font-weight: 600;
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, .85);
        border-radius: 12px;
        margin: 0 12px;
        transition: .3s;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, .08);
        color: #FFF0DC !important;
    }

    .sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, .15);
    }

    .logout-modal {
        border: none;
        border-radius: 30px;
        padding: 25px;
    }

    .logout-title {
        text-align: center;
        font-size: 30px;
        font-weight: 700;
        color: #131010;
        margin-bottom: 15px;
    }

    .logout-text {
        text-align: center;
        color: #8A8A8A;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .logout-actions {
        display: flex;
        justify-content: center;
        gap: 14px;
    }

    .btn-cancel {
        min-width: 140px;
        height: 50px;
        border: 1px solid #D8CBB9;
        background: #fff;
        color: #131010;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .3s;
    }

    .btn-cancel:hover {

        background: #F8F5F0;
    }

    .btn-confirm-logout {
        min-width: 140px;
        height: 50px;
        background: #131010;
        color: #fff !important;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: .3s;
    }

    .btn-confirm-logout:hover {
        background: #543A14;
        text-decoration: none;
    }
</style>

<ul
    class="navbar-nav sidebar sidebar-dark accordion"
    id="accordionSidebar"
    style="
        background:#543A14;
        min-height:100vh;
        width:280px;
    ">

    <!-- LOGO -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center py-4"
        href="dashboard.php">

        <img
            src="../assets/images/logo/logo-white-admin.svg"
            alt="Domio"
            class="img-fluid"
            style="max-width:130px;">

    </a>

    <hr class="sidebar-divider my-0">

    <div class="text-center py-4">

        <div
            style="
                width:90px;
                height:90px;
                background:#FFF0DC;
                border-radius:50%;
                display:flex;
                align-items:center;
                justify-content:center;
                margin:auto;">

            <i class="fas fa-user fa-2x"
                style="color:#543A14;"></i>

        </div>

        <div
            class="text-white
                font-weight-bold">

            <?= $_SESSION['admin_name'] ?? 'Admin'; ?>

        </div>

        <small
            style="color:rgba(255,255,255,.7);">

            Administrator

        </small>

    </div>

    <hr class="sidebar-divider">

    <!-- DASHBOARD -->
    <li class="nav-item <?= activeMenu(['dashboard.php']) ?>">

        <a class="nav-link" href="dashboard.php">

            <i class="fas fa-home"></i>

            <span>Dashboard</span>

        </a>

    </li>

    <!-- PRODUCTS -->
    <li class="nav-item <?= activeMenu([
                            'products.php',
                            'category-products.php',
                            'add-product.php',
                            'edit-product.php',
                            'product-detail.php',
                            'delete-product.php'
                        ]) ?>">

        <a class="nav-link" href="products.php">

            <i class="fas fa-couch"></i>

            <span>Products</span>

        </a>

    </li>

    <!-- ORDERS -->
    <li class="nav-item <?= activeMenu([
                            'orders.php',
                            'order-detail.php'
                        ]) ?>">

        <a class="nav-link" href="orders.php">

            <i class="fas fa-shopping-bag"></i>

            <span>Orders</span>

        </a>

    </li>

    <!-- USERS -->
    <li class="nav-item <?= activeMenu([
                            'users.php',
                            'user-detail.php'
                        ]) ?>">

        <a class="nav-link" href="users.php">

            <i class="fas fa-users"></i>

            <span>Users</span>

        </a>

    </li>

    <hr class="sidebar-divider">

    <!-- LOGOUT -->
    <li class="nav-item">

        <a
            class="nav-link"
            href="#"
            data-toggle="modal"
            data-target="#logoutModal">

            <i class="fas fa-sign-out-alt"></i>

            <span>Logout</span>

        </a>

    </li>

</ul>

<div
    class="modal fade"
    id="logoutModal"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content logout-modal">

            <div class="modal-body">

                <h2 class="logout-title">

                    Logout

                </h2>

                <p class="logout-text">

                    Are you sure you want
                    to logout from admin panel?

                </p>

                <div class="logout-actions">

                    <button
                        type="button"
                        class="btn-cancel"
                        data-dismiss="modal">

                        Cancel

                    </button>

                    <a
                        href="logout.php"
                        class="btn-confirm-logout">

                        Logout

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>