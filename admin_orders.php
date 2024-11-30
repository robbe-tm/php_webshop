<?php
@include 'includes/config.php';
@include 'includes/html.php';
@include 'includes/sql.php';
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
        <h1 class="title">Bestellingen</h1>
        <div class="box-container">
            <?php
            if ($show_orders->rowCount() > 0) {
                while (($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC))) {
            ?>
                    <div class="box">
                        <p>Id: <span><?= $fetch_orders['user_id'] ?></span></p>
                        <p>Naam: <span><?= $fetch_orders['name'] ?></span></p>
                        <p>Telefoonnummer: <span><?= $fetch_orders['number'] ?></span></p>
                        <p>E-mail: <span><?= $fetch_orders['email'] ?></span></p>
                        <p>Adres: <span><a target="_blank" href="<?= $fetch_orders['addressHref'] ?>"><?= $fetch_orders['address'] ?></a></span></p>
                        <p>Aantal producten: <span><?= $fetch_orders['total_products'] ?></span></p>
                        <p>Totale prijs: <span>&euro;<?= $fetch_orders['total_price'] ?></span></p>
                        <p>Geplaatst op: <span><?= $fetch_orders['placed_on'] ?></span></p>
                        <p>Betalingsstatus: <span></span></p>
                        <form action="" method="POST">
                            <input type="hidden" name="order_id" value="<?= $fetch_orders['id'] ?>">
                            <select name="update_payment_id" class="drop-down">
                                <option value="" selected disabled>Selecteer een status</option>
                                <?php
                                foreach ($statuses as $status) {
                                ?>
                                    <option value="<?= $status['id'] ?>" <?php if ($fetch_orders['payment_status_id'] == $status['id']) { ?>selected<?php } ?>><?= $status['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="flex-btn">
                                <button type="submit" name="update_order" class="goldIconButton fas fa-edit"></button>
                                <a href="admin_orders.php?delete_order=<?= $fetch_orders['id']; ?>" onclick="return confirm('Verwijder deze bestelling?');"><?=$trash_button?></a>
                            </div>
                        </form>
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