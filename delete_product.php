<?php
session_start();
require_once 'models/products.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$productId = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($productId > 0) {
    $productModel = new Product();
    $result = $productModel->deleteProduct($productId);
    if ($result) {
        echo "Product with ID $productId has been deleted.";
    } else {
        echo "Failed to delete product with ID $productId. Please check the database connection or query.";
    }
} else {
    echo "Invalid Product ID.";
}

header('Location: index.php');
exit();
?>
