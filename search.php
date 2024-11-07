<?php
    require_once 'models/products.php';

    $productModel = new Product();

    $searchTerm = isset($_GET['query']) ? $_GET['query'] : '';

    if ($searchTerm) {
        $products = $productModel->searchProducts($searchTerm);
        echo json_encode($products);
    }
?>
