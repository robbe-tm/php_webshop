<?php
@include 'message.php';
//header
$show_header = $conn->prepare("SELECT * FROM `headerIndex`");
$show_header->execute();
if (!isset($user_id)) {
 $countC = 0;
 $countW = 0;
} else {
    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $count_cart_items->execute([$user_id]);
    $countC = $count_cart_items->rowCount();
    $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
    $count_wishlist_items->execute([$user_id]);
    $countW = $count_wishlist_items->rowCount();
}

@include 'accountView.php';
?>
<header class="header">
    <div class="flex">
        <div class="imgLogo">
            <img class="imgDiv" src="images/Logo_BODInew.png" alt="logo">
        </div>
        <nav class="navbar">
            <?php
            if ($show_header->rowCount() > 0) {
                while ($fetch_header = $show_header->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <a title="<?= $fetch_header['name'] ?>" class="navlink" href="<?= $fetch_header['href'] ?>"><?= $fetch_header['name'] ?></a>
            <?php
                }
            }
            ?>
        </nav>
        <div class="icons">
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $countC ?>)</span></a>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $countW ?>)</span></a>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
        <div class="profile">
            <?= $profileDiv; ?>
        </div>
    </div>
</header>