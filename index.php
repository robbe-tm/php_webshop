<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
if (!isset($user_id)) {
    $name = '';
} else {
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    $name = $fetch_profile["firstname"] . ' '  . $fetch_profile["lastname"];
};

if (isset($_POST['add_to_wishlist'])) {
    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $p_name = $_POST['p_name'];
    $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
    $p_price = $_POST['p_price'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
    $p_image = $_POST['p_image'];
    $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

    $check_wishlist_number = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
    $check_wishlist_number->execute([$p_name, $user_id]);
    $check_cart_number = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_number->execute([$p_name, $user_id]);

    if ($check_wishlist_number->rowCount() > 0) {
        $message[] = 'Al toegevoegd aan de verlanglijst!';
    } elseif ($check_cart_number->rowCount() > 0) {
        $message[] = 'Al toegevoegd aan de winkelwagen!';
    } else {
        $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
        $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
        $message[] = 'Toegevoegd aan de verlanlijst!';
    }
}

if(isset($_POST['add_to_cart'])){

    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $p_name = $_POST['p_name'];
    $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
    $p_price = $_POST['p_price'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
    $p_image = $_POST['p_image'];
    $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
    $p_quantity = $_POST['p_quantity'];
    $p_quantity = filter_var($p_quantity, FILTER_SANITIZE_STRING);
 
    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->execute([$p_name, $user_id]);
 
    if($check_cart_numbers->rowCount() > 0){
       $message[] = 'Al toegevoegd  aan winkelmandje!';
    }else{
 
       $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
       $check_wishlist_numbers->execute([$p_name, $user_id]);
 
       if($check_wishlist_numbers->rowCount() > 0){
          $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
          $delete_wishlist->execute([$p_name, $user_id]);
       }
 
       $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
       $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_quantity, $p_image]);
       $message[] = 'Toegevoegd aan winkelmandje!';
    }
 
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoofdpagina</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
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
    <section class="home-category">
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