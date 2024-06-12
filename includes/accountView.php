<?php
if ($user_id == null) {
    $profileDiv = '
    <img class="imgProfile" src="projectImages/gray-photo-placeholder-icon-design-ui-vector-35850819.jpg" alt="">
    <div class="flex-btn">
        <a href="login.php" class="btn">Inloggen</a>
    </div>';
} else {
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    $profileDiv = '
        <img class="imgProfile" src="projectImages/gray-photo-placeholder-icon-design-ui-vector-35850819.jpg" alt="">
        <p class="profileText">' . $fetch_profile['firstname'] . $fetch_profile['lastname'] . '</p>
        <div class="flex-btn">
            <a href="user_profile_update.php" class="btn">Bewerk profiel</a>
            <a href="logout.php" class="delete-btn">Uitloggen</a>
        </div>';
}
