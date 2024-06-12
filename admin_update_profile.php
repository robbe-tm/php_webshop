<?php
@include 'includes/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
};

if (isset($_POST['update_profile'])) {
    $firstname = $_POST['firstname'];
    $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $lastname = $_POST['lastname'];
    $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    if (!empty($firstname) and !empty($lastname) and !empty($email)) {
        $update_profile = $conn->prepare("UPDATE `users` SET firstname = ?, lastname = ?, email = ? WHERE id = ?");
        $update_profile->execute([$firstname, $lastname, $email, $admin_id]);
        $message[] = 'Account succesvol bijgewerkt!';
    }
} elseif (isset($_POST['update_passW'])) {
    $old_pass = $_POST['old_pass'];
    $update_pass = md5($_POST['update_pass']);
    $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING);
    $new_pass = md5($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = md5($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if (!empty($update_pass) and !empty($new_pass) and !empty($confirm_pass)) {
        if ($update_pass != $old_pass) {
            $message[] = '"Oud wachtwoord" komt niet overeen!';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = '"Bevestig wachtwoord" komt niet overeen!';
        } else {
            $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass_query->execute([$confirm_pass, $admin_id]);
            $message[] = 'Wachtwoord succesvol veranderd!';
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk admin profiel</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_styles.css">
</head>

<body>
    <?php include 'includes/admin_header.php'; ?>

    <section class="update-profile">
        <h1 class="title">Bewerk profiel</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <img class="imgProfile" src="projectImages/gray-photo-placeholder-icon-design-ui-vector-35850819.jpg" alt="">
            <div class="flex">
                <div class="inputBox">
                    <span>Voornaam: </span>
                    <input type="text" name="firstname" value="<?= $fetch_profile['firstname']; ?>" placeholder="Bewerk voornaam" class="box" required>
                    <span>Achternaam: </span>
                    <input type="text" name="lastname" value="<?= $fetch_profile['lastname']; ?>" placeholder="Bewerk achternaam" class="box" required>
                    <span>E-mail: </span>
                    <input type="text" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="Bewerk e-mail" class="box" required>
                </div>
            </div>
            <div class="flex-btn">
                <input type="submit" class="btn" value="Bewerk profiel" name="update_profile">
                <a href="admin_page.php" class="delete-btn">Ga terug</a>
            </div>
        </form>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="inputBox">
                <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
                <span>Oud wachtwoord: </span>
                <input type="password" name="update_pass" placeholder="Voer u oud wachtwoord in" class="box" required>
                <span>Nieuw wachtwoord: </span>
                <input type="password" name="new_pass" placeholder="Voer u nieuw wachtwoord in" class="box" required>
                <span>Bevestig nieuw wachtwoord: </span>
                <input type="password" name="confirm_pass" placeholder="Bevestig nieuw wachtwoord" class="box" required>
            </div>
            <div class="flex-btn">
                <input type="submit" class="btn" value="Bewerk wachtwoord" name="update_passW">
                <a href="admin_page.php" class="delete-btn">Ga terug</a>
            </div>
        </form>
    </section>

    <script src="js/script.js"></script>
</body>

</html>