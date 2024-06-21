<?php

@include 'includes/config.php';
@include 'includes/html.php';
session_start();

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($select->rowCount() > 0) {
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        } else {
            $message[] = 'Geen gebruiker gevonden!';
        }
    } else {
        $message[] = 'Foutief e-mail adres of wachtwoord!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $login; ?>
</head>

<body>

    <?php
    @include 'includes/header/message.php';
    ?>
    <section class="formcontainer">
        <form action="" enctype="multipart/form-data" method="POST">
            <h3>Login</h3>
            <input type="email" name="email" class="box" placeholder="Voer u e-mail in" required>
            <input type="password" name="pass" class="box" placeholder="Voer u wachtwoord in" required>
            <input type="submit" value="Login" class="btn" name="submit">
            <p>Heb je nog geen account? <a href="register.php">Registreren</a></p>
        </form>
    </section>
</body>

</html>