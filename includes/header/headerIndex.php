<?php
@include 'message.php';
@include 'headerCount.php';
$show_header = $conn->prepare("SELECT * FROM `headerIndex`");
$show_header->execute();
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
                    <a title="<?= $fetch_header['name'] ?>" class="<?= $fetch_header['class'] ?>" href="<?= $fetch_header['href'] ?>"><?= $fetch_header['name'] ?></a>
            <?php
                }
            }
            ?>
            <a href="search_page.php" class="fas fa-search navlink"></a>
        </nav>
        <div class="icons">
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $countC ?>)</span></a>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $countW ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
        <div class="profile">
            <?= $profileDiv; ?>
        </div>
    </div>
</header>