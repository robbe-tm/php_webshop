<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
if (!isset($user_id)) {
}
@include 'includes/add_to_wish_cart.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snel overzicht</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php @include 'includes/header/header.php'; ?>
    <section class="quick-view">
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
                    <img src="uploaded_img/<?= $fetch_products['image'] ?>" alt="">
                    <div class="name"><?= $fetch_products['name'] ?></div>
                    <div class="description"><?= $fetch_products['description'] ?></div>
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
    </section>
    <?php @include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>