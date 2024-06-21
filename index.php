<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
@include 'includes/html.php';
if (!isset($user_id)) {
    $name = '';
} else {
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    $name = $fetch_profile["firstname"] . ' '  . $fetch_profile["lastname"];
};
@include 'includes/add_to_wish_cart.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $home; ?>
    <?= $head; ?>
</head>

<body>
    <?php @include 'includes/header/headerIndex.php'; ?>
    <div class="home-bg">
        <section class="home">
            <div class="content">
                <h3>Bodi</h3>
                <p>Bedrukkingen van kledij en diverse materialen</p>
                <img class="bigLogoH" src="images/Logo_BODInewzwart.png" alt="logo">
            </div>
        </section>
    </div>
    <section id="categorys" class="home-category">
        <h1 class="title">Welkom <?= $name ?>!</h1>
        <h1 class="title">Winkelen per categorie</h1>
        <div class="box-container">
            <?php
            $show_categorys = $conn->prepare("SELECT * FROM `categorys`");
            $show_categorys->execute();
            if ($show_categorys->rowCount() > 0) {
                while ($fetch_categorys = $show_categorys->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <i class="<?= $fetch_categorys['icon']; ?> catIcon"></i>
                        <h3><?= $fetch_categorys['name'] ?></h3>
                        <p><?= $fetch_categorys['description']; ?></p>
                        <a href="category.php?category=<?= $fetch_categorys['name'] ?>" class="btn"><?= $fetch_categorys['name'] ?></a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Geen categorieën gevonden!</p>';
            }
            ?>
        </div>
    </section>
    <section class="products">
        <h1 class="title">Nieuwste producten</h1>
        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="post" class="box">
                        <div class="price">&euro;<?= $fetch_products['price'] ?></div>
                        <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="fas fa-eye"></a>
                        <img src="uploaded_img/<?= $fetch_products['image'] ?>" alt="">
                        <div class="name"><?= $fetch_products['name'] ?></div>
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
    <?php @include 'includes/footer.php' ?>
    <script src="js/script.js"></script>
</body>

</html>