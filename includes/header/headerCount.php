<?php
if(!isset($user_id)){ 
    $countC = 0;
    $countW = 0;
} else {
    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $count_cart_items->execute([$user_id]);
    $countC = $count_cart_items->rowCount();
    $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
    $count_wishlist_items->execute([$user_id]);
    $countW = $count_wishlist_items->rowCount();
};?>