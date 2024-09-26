<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
@include 'includes/html.php';
if (!isset($user_id)) {
} else {
}
$select_categorys = $conn->prepare("SELECT * FROM `categorys`");
$select_categorys->execute();
$select_products = $conn->prepare("SELECT * FROM `products`");
$select_products->execute();
$countAllProducts = $select_products->rowCount();
@include 'includes/add_to_wish_cart.php';
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
        <h1 class="title">Alle producten(<?= $countAllProducts; ?>)</h1>
        <div class="box-container">
        </div>
        <div class="box-container">
            <?php
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="post" class="box">
                        <div class="price">&euro;<?= $fetch_products['price'] ?></div>
                        <?= $wishButton; ?>
                        <a title="Klik op de afbeelding om meer informatie te weten van dit product" href="view_page.php?pid=<?= $fetch_products['id'] ?>"><img src="uploaded_img/<?= $fetch_products['image'] ?>" alt=""></a>
                        <div class="name"><?= $fetch_products['name'] ?></div>
                        <div class="category"><?= $fetch_products['category']; ?></div>
                        <input type="hidden" name="pid" value="<?= $fetch_products['id'] ?>">
                        <input type="hidden" name="p_name" value="<?= $fetch_products['name'] ?>">
                        <input type="hidden" name="p_price" value="<?= $fetch_products['price'] ?>">
                        <input type="hidden" name="p_image" value="<?= $fetch_products['image'] ?>">
                        <input type="number" min="1" value="1" name="p_quantity" class="quantity">
                        <?= $cartButton; ?>
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