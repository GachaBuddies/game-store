<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($productId > 0) {
        require_once 'models/products.php';
        $productModel = new Product();
        $product = $productModel->getProductById($productId);

        if ($product) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $exists = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] === $productId) {
                    $exists = true;
                    $item['quantity'] += 1;
                    break;
                }
            }

            if (!$exists) {
                $_SESSION['cart'][] = [
                    'id' => $productId,
                    'name' => $product['productName'],
                    'price' => $product['price'],
                    'picture' => $product['picture'],
                    'quantity' => 1,
                ];
            }
        }
    }

    header('Location: cart.php');
    exit();
}

?>
