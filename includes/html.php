<?php
$home = '<title>Hoofdpagina</title>';
$register = '<title>Registreren</title>';
$login = '<title>Login</title>';
$profileP = '<title>Bewerk gebruikers profiel</title>';
$details = '<title>Snel overzicht</title>';
$wish = '<title>Verlanglijst</title>';
$search = '<title>Zoek pagina</title>';
$contact = '<title>Contact</title>';
$orders = '<title>Bestellingen</title>';
$shop = '<title>Webshop</title>';
$cart = '<title>Winkelwagen</title>';
$checkout = '<title>Afrekenen</title>';
$category = '<title>Categorie</title>';
$users = '<title>Gebruikers</title>';
$editProfile = '<title>Bewerk admin profiel</title>';
$editProduct = '<title>Bewerk product</title>';
$products = '<title>Producten</title>';
$admin = '<title>Admin pagina</title>';
$messagePage = '<title>Berichten</title>';
$head = '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">
        ';
$headAdmin = '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/admin_styles.css">
        ';
$startHeaderA = '
<header class="header">
    <div class="flex">
        <a href="admin_page.php" class="logo">Admin<span>Bodi</span></a>
        <nav class="navbar">
';
$iconsHeaderA = '
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
';
$productsA = '
    <a class="navlink" href="admin_products.php">Producten</a>
';
$productsAddA = '
    <a class="specialColor">Producten - Toevoegen</a>
';
$productsEditA = '
    <a class="specialColor"> Producten - Bewerken</a>
';
$ordersA = '
    <a class="navlink" href="admin_orders.php">Bestellingen</a>
';
$usersA = '
    <a class="navlink" href="admin_users.php">Gebruikers</a>
';
$messageA = '
    <a class="navlink" href="admin_contacts.php">Berichten</a>
';
$goback = '
    <p class="textUTitle"><a href="admin_products.php"><i class="fa-solid fa-arrow-left"></i> Ga terug</a></p>
';
$no_products = '
    <p class="empty">Geen producten gevonden!</p>
';
//Wish en cart button
if ($user_id == null) {
    $wishButton = '<button name="login_btn" class="redIconButton fas fa-heart"></button>';
    $cartButton = '<button name="login_btn" class="goldIconButton fa fa-shopping-cart"></button>';
} else {
    $wishButton = '<button type="submit" class="redIconButton fas fa-heart" name="add_to_wishlist"></button>';
    $cartButton = '<button type="submit" class="goldIconButton fa fa-shopping-cart" name="add_to_cart"></button>';
}
//Edit and go back button product
$editButton = '<button type="submit" class="goldIconButton fas fa-edit" name="update_product"></button>';
$undoButton = '<button name="undo_button" class="redIconButton fas fa-undo"></button>';
//Standard edit and delete button
$edit_button = '<button><i class="goldIconButton fas fa-edit"></i></button>';
$trash_button = '<button><i class="redIconButton fas fa-trash-alt"></i></button>';
?>