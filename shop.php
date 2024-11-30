<?php
//Includes
@include 'includes/config.php';
@include 'includes/loggedIn.php';
@include 'includes/html.php';
@include 'includes/add_to_wish_cart.php';
@include 'includes/sql.php';
if (!isset($user_id)) {
} else {
}
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
            <?php
            if ($show_products->rowCount() > 0) {
                while (($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) && ($fetch_products_inc_cat = $show_products_inc_cat->fetch(PDO::FETCH_ASSOC))) {
                    //     $array = [
                    //         $fetch_products['name']
                    //     ];
                    //     echo "$array[0]";
            ?>

                    <form action="" method="post" class="box">
                        <div class="price">&euro;<?= $fetch_products['price'] ?></div>
                        <?= $wishButton; ?>
                        <a title="Klik op de afbeelding om meer informatie te weten van dit product" href="view_page.php?pid=<?= $fetch_products['id'] ?>">
                            <?php
                            if ($fetch_products['image'] != null) {
                            ?>
                                <img src="uploaded_img/<?= $fetch_products['image'] ?>" alt="">
                            <?php
                            } else {
                            ?>
                                <img src="projectImages/placeholder_Image.png">
                                    <?php
                                }
                                    ?>
                                    </a>
                                <div class="name"><?= $fetch_products['name'] ?></div>
                                <div class="category"><?= $fetch_products_inc_cat['name']; ?></div>
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
                echo $no_products;
            }
            ?>
        </div>
    </section>
    <?php @include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>