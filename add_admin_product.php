<?php
@include 'includes/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
};
if (isset($_POST['add_product'])) {
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

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'Product naam al in gebruik!';
    } else {
        $insert_products = $conn->prepare("INSERT INTO `products`(name, category, description, price, image) VALUES(?,?,?,?,?)");
        $insert_products->execute([$name, $category, $description, $price, $image]);
        if ($insert_products) {
            if ($image_size > 2000000) {
                $message[] = 'Afbeelding is te groot!';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Nieuw product toegevoegd!';
                header('location:admin_products.php');
            }
        }
    }
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_styles.css">
</head>

<body>
    <?php include 'includes/admin_header.php'; ?>
    <section class="add_product">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="flex">
                <div class="inputBox">
                    <input type="text" name="name" class="box" required placeholder="Vul product naam in">
                    <select name="category" class="box">
                        <option value="" selected disabled>Selecteer categorie</option>
                        <option value="Babykledij">Babykledij</option>
                        <option value="Kinderkledij">Kinderkledij</option>
                        <option value="Dameskledij">Dameskledij</option>
                        <option value="Herenkledij">Herenkledij</option>
                        <option value="Stickers">Stickers</option>
                    </select>
                </div>
                <div class="inputBox">
                    <input type="decimal" min="0" name="price" class="box" required placeholder="Vul prijs in(0.00)">
                    <input name="image" type="file" required class="box" accept="image/jpg, image/jpeg, image/png">
                </div>
            </div>
            <textarea name="description" cols="30" rows="10" required class="box" placeholder="Vul beschrijving product in"></textarea>
            <input type="submit" class="btn" value="Voeg product toe" name="add_product">
        </form>
    </section>
</body>