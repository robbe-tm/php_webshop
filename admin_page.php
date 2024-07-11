<?php
@include 'includes/config.php';
@include 'includes/html.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= $headAdmin; ?>
    <?= $admin; ?>
</head>

<body>
    <?php include 'includes/header/admin_header.php'; ?>
    <section class="dashboard">
        <h1 class="title">Dashboard</h1>
        <div class="box-container">
            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_pendings->execute(['pending']);
                while ($fetch_pending = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                    $total_pendings += $fetch_pending['total_price'];
                };
                ?>
                <h3>&euro;<?= $total_pendings ?>/-</h3>
                <p>Lopende bestellingen</p>
                <a href="admin_orders.php" class="btn">Zie bestellingen</a>
            </div>

            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_completed->execute(['completed']);
                while ($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)) {
                    $total_completed += $fetch_completed['total_price'];
                };
                ?>
                <h3>&euro;<?= $total_completed ?>/-</h3>
                <p>Afgeronde bestellingen</p>
                <a href="admin_orders.php" class="btn">Zie bestellingen</a>
            </div>
            <div class="box">
                <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                $number_of_orders = $select_orders->rowCount();
                ?>
                <h3><?= $number_of_orders ?></h3>
                <p>Bestellingen geplaatst</p>
                <a href="admin_orders.php" class="btn">Zie bestellingen</a>
            </div>
            <div class="box">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                $number_of_products = $select_products->rowCount();
                ?>
                <h3><?= $number_of_products ?></h3>
                <p>Producten toegevoegd</p>
                <a href="admin_products.php" class="btn">Zie producten</a>
            </div>
            <div class="box">
                <?php
                $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
                $select_users->execute(['user']);
                $number_of_users = $select_users->rowCount();
                ?>
                <h3><?= $number_of_users ?></h3>
                <p>Gebruikers</p>
                <a href="admin_users.php" class="btn">Zie gebruikers</a>
            </div>
            <div class="box">
                <?php
                $select_admin = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
                $select_admin->execute(['admin']);
                $number_of_admin = $select_admin->rowCount();
                ?>
                <h3><?= $number_of_admin ?></h3>
                <p>Admin gebruikers</p>
                <a href="admin_users.php" class="btn">Zie admins</a>
            </div>
            <div class="box">
                <?php
                $select_accounts = $conn->prepare("SELECT * FROM `users`");
                $select_accounts->execute();
                $number_of_accounts = $select_accounts->rowCount();
                ?>
                <h3><?= $number_of_accounts ?></h3>
                <p>Accounts</p>
                <a href="admin_users.php" class="btn">Zie accounts</a>
            </div>
            <div class="box">
                <?php
                $select_messages = $conn->prepare("SELECT * FROM `message`");
                $select_messages->execute();
                $number_of_messages = $select_messages->rowCount();
                ?>
                <h3><?= $number_of_messages ?></h3>
                <p>Berichten</p>
                <a href="admin_contacts.php" class="btn">Zie berichten</a>
            </div>

        </div>
    </section>
    <script src="js/script.js"></script>
</body>

</html>