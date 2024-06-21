<?php
@include 'includes/config.php';
@include 'includes/html.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
};
if (isset($_POST['update_product'])) {
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $old_image = $_POST['old_image'];
    $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, description = ?, price = ? WHERE id = ?");
    $update_product->execute([$name, $category, $description, $price, $pid]);
    $message[] = 'Product succesvol bijgewerkt!';

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $message[] = 'Afbeelding is te groot!';
        } else {

            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $pid]);

            if ($update_image) {
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('uploaded_img/' . $old_image);
                $message[] = 'Afbeelding succesvol bijgewerkt!';
            }
        }
    }
    header("location:admin_products.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $editProduct; ?>
</head>

<body>
    <?php include 'includes/header/admin_header.php'; ?>
    <section class="update-product">
        <h1 class="title">Bewerk product</h1>
        <?php
        $update_id = $_GET['update'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$update_id]);
        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                    <input type="text" name="name" placeholder="Vul product naam in" required class="box" value="<?= $fetch_products['name']; ?>">
                    <input type="decimal" name="price" placeholder="Vul prijs in(0.00)" required class="box" value="<?= $fetch_products['price']; ?>">
                    <select name="category" class="box">
                        <option selected><?= $fetch_products['category']; ?></option>
                        <option value="Babykledij">Babykledij</option>
                        <option value="Kinderkledij">Kinderkledij</option>
                        <option value="Dameskledij">Dameskledij</option>
                        <option value="Herenkledij">Herenkledij</option>
                        <option value="Stickers">Stickers</option>
                    </select>
                    <textarea name="description" cols="30" rows="10" required class="box" placeholder="Vul beschrijving product in"><?= $fetch_products['description']; ?></textarea>
                    <input name="image" type="file" class="box" accept="image/jpg, image/jpeg, image/png">
                    <div class="flex-btn">
                        <input type="submit" class="btn" value="Bewerk product" name="update_product">
                        <a href="admin_products.php" class="delete-btn">Ga terug</a>
                    </div>
                </form>
        <?php
            }
        } else {
            echo '<p class="empty">Geen product gevonden!</p>';
        }
        ?>
    </section>



    <script src="js/script.js"></script>
</body>

</html>