<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
@include 'includes/html.php';
if (!isset($user_id)) {
} else {
}
$select_categorys = $conn->prepare("SELECT * FROM `categorys`");
$select_categorys->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $shop; ?>
</head>

<body>
    <?php include 'includes/header/header.php' ?>
    <section class="products">
        <h1 class="title">Alle producten</h1>
        <div class="box-container">
            <!-- <form action="" method="get">
                <div class="filter">
                    <h1 class="title">Filter
                        <button type="submit" class="btn">Zoeken</button>
                    </h1>
                </div>
            </form> -->

        </div>
        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="post" class="box">
                        <div class="price">&euro;<?= $fetch_products['price'] ?></div>
                        <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="fas fa-eye"></a>
                        <img src="uploaded_img/<?= $fetch_products['image'] ?>" alt="">
                        <div class="name"><?= $fetch_products['name'] ?></div>
                        <div class="category"><?= $fetch_products['category']; ?></div>
                        <input type="hidden" name="pid" value="<?= $fetch_products['id'] ?>">
                        <input type="hidden" name="p_name" value="<?= $fetch_products['name'] ?>">
                        <input type="hidden" name="p_price" value="<?= $fetch_products['price'] ?>">
                        <input type="hidden" name="p_image" value="<?= $fetch_products['image'] ?>">
                        <input type="number" min="1" value="1" name="p_quantity" class="quantity">
                        <input type="submit" value="Verlanlijst" class="btn" name="add_to_wishlist">
                        <input type="submit" value="Winkelwagen" class="btn" name="add_to_cart">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">Geen producten gevonden!</p>';
            }
            ?>
        </div>
    </section>




    <?php @include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>