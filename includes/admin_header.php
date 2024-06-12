<?php @include 'message.php'; ?>
<header class="header">
    <div class="flex">
        <a href="admin_page.php" class="logo">Admin<span>Bodi</span></a>
        <nav class="navbar">
            <a class="navlink" href="admin_page.php">Hoofdpagina</a>
            <a class="navlink" href="admin_products.php">Producten</a>
            <a class="navlink" href="admin_orders.php">Bestellingen</a>
            <a class="navlink" href="admin_users.php">Gebruikers</a>
            <a class="navlink" href="admin_contacts.php">Berichten</a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <?php @include 'adminAccountView.php'; ?>
    </div>
</header>