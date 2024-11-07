<?php
require_once 'models/products.php';
$productModel = new Product();

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query === '') {
    $products = $productModel->getAllProducts(); // Fetch all products
} else {
    $products = $productModel->searchProductsByName($query);
}

foreach ($products as $product) {
    echo '<div class="game-card">';
    echo '<img src="images/' . htmlspecialchars($product['picture']) . '" alt="Game Thumbnail">';
    echo '<div class="content">';
    echo '<h2>' . htmlspecialchars($product['productName']) . '</h2>';
    echo '<h3 class="price">' . ($product['price'] == 0 ? 'Free' : '$' . htmlspecialchars($product['price'])) . '</h3>';
    echo '<p>' . substr(htmlspecialchars($product['description']), 0, 150) . '...</p>';
    echo '</div></div>';
}
?>