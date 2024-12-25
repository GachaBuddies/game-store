<?php
session_start();
require_once 'models/products.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($productId > 0) {
    $productModel = new Product();
    $result = $productModel->deleteProduct($productId);
    if ($result) {
        $_SESSION['message'] = "Product with ID $productId has been deleted.";
    } else {
        $_SESSION['message'] = "Failed to delete product with ID $productId.";
    }
} else {
    $_SESSION['message'] = "Invalid Product ID.";
}

header('Location: admin.php?active_tab=games');
exit();
?>
