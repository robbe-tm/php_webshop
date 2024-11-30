<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
@include 'includes/sql.php';
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
        <?php
        foreach ($cats as $cat) {
            if ($category_name == $cat['id']) {
        ?>
                <h1 class="title"><?= $cat['name'] ?></h1>
        <?php
            }
        }
        ?>
        <h1 class="title"></h1>
        <p class="textUTitle">Aantal producten(<?= $countProducts; ?>)</p>
        <div class="box-container">
            <?php
            if ($show_products_by_cat->rowCount() > 0) {
                while ($fetch_products = $show_products_by_cat->fetch(PDO::FETCH_ASSOC)) {
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