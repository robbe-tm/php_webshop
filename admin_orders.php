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
    <?= $orders; ?>
</head>

<body>
    <?php include 'includes/header/admin_header.php'; ?>
    <section class="placed-orders">
        <div class="box-container">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {

            ?>
                    <div class="box">
                        <p>Id: <span><?= $fetch_orders['user_id'] ?></span></p>
                        <p>Naam: <span><?= $fetch_orders['name'] ?></span></p>
                        <p>Telefoonnummer: <span><?= $fetch_orders['number'] ?></span></p>
                        <p>E-mail: <span><?= $fetch_orders['email'] ?></span></p>
                        <?php
                        // str_replace(" ", "+", $fetch_orders['address']);
                        ?>
                        <p>Adres: </p><a href="<?= $fetch_orders['addressHref']?>"><?= $fetch_orders['address']?></a>
                        <p>Aantal producten: <span><?= $fetch_orders['total_products'] ?></span></p>
                        <p>Totale prijs: <span><?= $fetch_orders['total_price'] ?></span></p>
                        <p>Geplaatst op: <span><?= $fetch_orders['placed_on'] ?></span></p>
                        <p>Betalingsstatus: <span><?= $fetch_orders['payment_status'] ?></span></p>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Geen bestellingen geplaatst!</p>';
            }
            ?>
        </div>
    </section>


    <script src="js/script.js"></script>
</body>

</html>