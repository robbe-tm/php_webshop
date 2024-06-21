<?php
@include 'includes/config.php';
@include 'includes/html.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
};
if (isset($_POST['add_product'])) {
    $message[] = 'Nieuw product toegevoegd!';
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $select_delete_image->execute([$delete_id]);
    $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_products->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    header('location:admin_products.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $products; ?>
</head>

<body>
    <?php include 'includes/header/admin_header.php'; ?>
    <section class="add_product">
        <h1 class="title">Nieuw product toevoegen</h1>
        <a href="add_admin_product.php" class="btn">Toevoegen</a>
    </section>
    <section class="show-products">
        <h1 class="title">Producten toegevoegd</h1>
        <div class="box-container">
            <?php
            $show_products = $conn->prepare("SELECT * FROM `products`");
            $show_products->execute();
            if ($show_products->rowCount() > 0) {
                while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <div class="price">&euro;<?= $fetch_products['price']; ?>/-</div>
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="category"><?= $fetch_products['category']; ?></div>
                        <div class="description"><?= $fetch_products['description']; ?></div>
                        <div class="flex-btn">
                            <a href="admin_update_product.php?update=<?= $fetch_products['id']; ?>" class="btn">Bewerk</a>
                            <a href="admin_products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Verwijder dit product?')">Verwijder</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Geen producten toegevoegd!</p>';
            }
            ?>
        </div>
    </section>


    <script src="js/script.js"></script>
</body>

</html>