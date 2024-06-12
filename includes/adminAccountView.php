<div class="profile">
    <?php
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$admin_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
    <img class="imgProfile" src="projectImages/gray-photo-placeholder-icon-design-ui-vector-35850819.jpg" alt="">
    <p class="profileText"><?= $fetch_profile['firstname']; ?> <?= $fetch_profile['lastname']; ?></p>
    <div class="flex-btn">
        <a href="admin_update_profile.php" class="btn">Bewerk profiel</a>
        <a href="logout.php" class="delete-btn">Uitloggen</a>
    </div>
</div>