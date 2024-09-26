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
    <?= $users; ?>
</head>

<body>
    <?php include 'includes/header/admin_header.php'; ?>

    <section class="user-accounts">
        <?php 
        $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = 'admin'");
        $select_users->execute();
        $countA = $select_users->rowCount(); 
        ?>
        <h1 class="title">Admin(<?= $countA ?>)</h1>
        <div class="box-container">
            <?php
            @include 'includes/userComponent.php';
            ?>
        </div>
    </section>
    <section class="user-accounts">
    <?php 
        $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = 'user'");
        $select_users->execute();
        $countU = $select_users->rowCount(); 
        ?>
        <h1 class="title">Gebruikers(<?= $countU ?>)</h1>
        <div class="box-container">
            <?php
            @include 'includes/userComponent.php';
            ?>
        </div>
    </section>

    <script src="js/script.js"></script>
</body>

</html>