<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
$category_name = $_GET['category'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
$select_products->execute([$category_name]);
$countProducts = $select_products->rowCount();
@include 'includes/add_to_wish_cart.php';
@include 'includes/html.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $category; ?>
</head>

<body>
    <?php @include 'includes/header/header.php'; ?>
    <section class="products">
        <p class="textUTitle"><a href="index.php#categorys"><i class="fa-solid fa-arrow-left"></i> Ga terug</a></p>
        <h1 class="title"><?= $category_name; ?></h1>
        <p class="textUTitle">Aantal producten(<?= $countProducts; ?>)</p>
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
                echo '<p class="empty">Geen producten in deze categorie!</p>';
            }
            ?>
        </div>

    </section>
    <?php @include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>