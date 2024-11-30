<?php
//Products
/*Show products*/
$show_products = $conn->prepare("SELECT * FROM `products`");
$show_products->execute();
/*Show products inc category*/
$show_products_inc_cat = $conn->prepare("SELECT * FROM products JOIN categorys on products.category=categorys.id");
$show_products_inc_cat->execute();
/*Show latest products*/
$show_products_latest = $conn->prepare("SELECT * FROM `products` LIMIT 6");
$show_products_latest->execute();
/*Show products by category*/
$category_name = $_GET['category'];
$show_products_by_cat = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
$show_products_by_cat->execute([$category_name]);
/*Count all products*/
$countAllProducts = $show_products->rowCount();
/*Count products by category*/
$countProducts = $show_products_by_cat->rowCount();
/*Show all categorys*/
$show_categorys = $conn->prepare("SELECT * FROM `categorys`");
$show_categorys->execute();
/*Show the name of the categorys*/
$show_cat_name = $conn->prepare("SELECT * FROM `categorys`");
$show_cat_name->execute();
$cats = $show_cat_name->fetchAll();
/*Add product*/
if (isset($_POST['add_product'])) {
    $message[] = 'Nieuw product toegevoegd!';
}
/*Delete product*/
if (isset($_GET['delete_product'])) {
    $delete_id = $_GET['delete_product'];
    $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $select_delete_image->execute([$delete_id]);
    $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_products->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    header('location:admin_products.php');
}
//Orders
/*Show orders*/
$show_orders = $conn->prepare("SELECT * FROM orders");
$show_orders->execute();
/*Show payment statuses*/
$show_payment_status = $conn->prepare("SELECT * FROM `payment_status`");
$show_payment_status->execute();
$statuses = $show_payment_status->fetchAll();
/*Update order*/
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment_id = $_POST['update_payment_id'];
    $update_payment_id = filter_var($update_payment_id, FILTER_SANITIZE_STRING);
    $update_orders = $conn->prepare(("UPDATE `orders` SET payment_status_id = ? WHERE id = ?"));
    $update_orders->execute([$update_payment_id, $order_id]);
    header('location:admin_orders.php');
};
/*Delete order*/
if (isset($_GET['delete_order'])) {
    $delete_id = $_GET['delete_order'];
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_orders->execute([$delete_id]);
    header('location:admin_orders.php');
}
?>
