<?php
@include 'includes/config.php';
@include 'includes/loggedIn.php';
@include 'includes/html.php';
if (!isset($user_id)) {
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= $cart; ?>
    <?= $head; ?>
</head>

<body>
    <?php @include 'includes/header/headerCart.php';?>






    <?php @include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>