<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
@include 'includes/html.php';
if (!isset($user_id)) {
}
@include 'includes/add_to_wish_cart.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $details; ?>
</head>

<body>
    <?php @include 'includes/header/header.php'; ?>
    <section class="quick-view">
        <p class="textUTitle"><a href="index.php#categorys"><i class="fa-solid fa-arrow-left"></i> Ga terug</a></p>
        <h1 class="title">Snel overzicht</h1>
        <?php
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$pid]);
        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <form action="" method="post" class="box">
                    <div class="price">&euro;<?= $fetch_products['price'] ?></div>
                    <?= $wishButton; ?>
                    <a title="Klik op de afbeelding om meer informatie te weten van dit product" href="view_page.php?pid=<?= $fetch_products['id'] ?>"><img src="uploaded_img/<?= $fetch_products['image'] ?>" alt=""></a>
                    <div class="name"><?= $fetch_products['name'] ?></div>
                    <div class="category"><?= $fetch_products['category']; ?></div>
                    <div class="description"><?= $fetch_products['description'] ?></div>
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
    </section>
    <?php @include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>