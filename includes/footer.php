<?php
$link = 'https://www.google.com/maps/place/Dreef+4b,+2223+Heist-op-den-Berg/@51.0303428,4.6913093,16z/data=!3m1!4b1!4m6!3m5!1s0x47c1591c5653900f:0x5605dffd6b8e6e85!8m2!3d51.0303395!4d4.6938842!16s%2Fg%2F11hgfnpbpn?entry=ttu';
//header
$show_header = $conn->prepare("SELECT * FROM `header`");
$show_header->execute();
?>
<footer class="footer">
    <section class="box-container">
        <div class="box">
            <h3>Snelle links</h3>
            <?php
            if ($show_header->rowCount() > 0) {
                while ($fetch_header = $show_header->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <a href="<?= $fetch_header['href'] ?>"><i class="fas fa-angle-right"></i><?= $fetch_header['name'] ?></a>
            <?php
                }
            }
            ?>
        </div>
        <div class="box">
            <h3>Extra links</h3>
            <a href="cart.php"><i class="fas fa-angle-right"></i>Winkelwagen</a>
            <a href="wishlist.php"><i class="fas fa-angle-right"></i>Verlanglijst</a>
        </div>
        <div class="box">
            <h3>Contact info</h3>
            <p><a href="tel:+32476652413"><i class="fas fa-phone"></i>+32476 65 24 13</a></p>
            <p><a href="mailto:robbepeeters11@gmail.com"><i class="fas fa-envelope"></i>robbepeeters11@gmail.com</a> </p>
            <p><a href="<?= $link ?>" target="_blank"><i class="fas fa-map-marker-alt" target="_blank"></i>Dreef 4b, 2223 Schriek</a> </p>
        </div>
        <div class="box">
            <h3>Volg ons</h3>
            <a href="https://www.facebook.com/bodiclothes" target="_blank"><i class="fab fa-facebook-f"></i>Facebook</a>
            <a href="https://www.instagram.com/bodi_clothes_/" target="_blank"><i class="fab fa-instagram"></i>Instagram</a>
            <a href="https://www.tiktok.com/@bodi_clothes_" target="_blank"><i class="fab fa-tiktok"></i>Tiktok</a>
        </div>
    </section>
    <p class="credit"> &copy; copyright @ <?= date('Y'); ?> by <span>robbepeeters11@gmail.com</span></p>
</footer>