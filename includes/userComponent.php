<?php
while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
?>
    <div class="box">
        <p>Gebruiker id: <span><?= $fetch_users['id']; ?></span></p>
        <p>Naam: <span><?= $fetch_users['firstname']; ?> <?= $fetch_users['lastname']; ?></span></p>
        <p>E-mail: <span><?= $fetch_users['email']; ?></span></p>
        <p>Type: <span style="color:<?php
                                    if ($fetch_users['user_type'] == 'admin') {
                                        echo 'green';
                                    }
                                    if ($fetch_users['user_type'] == 'user') {
                                        echo 'red';
                                    }
                                    ?>"><?= $fetch_users['user_type']; ?></span></p>
        <a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('Verwijder deze gebruiker?');" class="delete-btn">Verwijder</a>
    </div>
<?php
}
?>