<?php
@include 'includes/config.php';
@include 'includes/html.php';
@include 'includes/sql.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $headAdmin; ?>
    <?= $products; ?>
</head>

<body>
    <?php include 'includes/header/admin_header.php'; ?>
    <section class="add_product">
        <a href="add_admin_product.php" class="btn">Product toevoegen</a>
    </section>
    <section class="products">
        <h1 class="title">Producten(<?= $countAllProducts; ?>)</h1>
        <div class="box-container">
            <?php
            if ($show_products->rowCount() > 0) {
                while (($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) && $fetch_products_inc_cat = $show_products_inc_cat->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <div class="price">&euro;<?= $fetch_products['price']; ?>/-</div>
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="category"><?= $fetch_products_inc_cat['name']; ?></div>
                        <div class="description"><?= $fetch_products['description']; ?></div>
                        <a href="admin_update_product.php?update=<?= $fetch_products['id']; ?>"><?=$edit_button?></a>
                        <a href="admin_products.php?delete_product=<?= $fetch_products['id']; ?>" onclick="return confirm('Verwijder dit product?')"><?=$trash_button?></a>
                    </div>
            <?php
                }
            } else {
                echo $no_products;
            }
            ?>
        </div>
    </section>


    <script src="js/script.js"></script>
</body>

</html>