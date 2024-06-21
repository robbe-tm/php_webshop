<?php
@include 'includes/config.php';
@include 'includes/html.php';
session_start();
$user_id = $_SESSION['user_id'];


if (!isset($user_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $search; ?>
</head>

<body>
    <?php @include 'includes/header/header.php'; ?>






    <?php @include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>