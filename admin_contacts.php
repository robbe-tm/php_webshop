<?php
@include 'includes/config.php';
@include 'includes/html.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
    <?= $messagePage; ?>
</head>

<body>
    <?php include 'includes/header/admin_header.php'; ?>



    <script src="js/script.js"></script>
</body>

</html>