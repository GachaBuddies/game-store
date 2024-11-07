<?php
    require_once 'models/products.php';
    $productModel = new Product();

    $query = isset($_GET['query']) ? trim($_GET['query']) : '';
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $productsPerPage = 15;
    $offset = ($currentPage - 1) * $productsPerPage;

    if (isset($_GET['count']) && $_GET['count'] == 'true') {
        if ($query === '') {
            $count = $productModel->getTotalProductsCount();
        } else {
            $products = $productModel->searchProductsByName($query);
            $count = count($products);
        }
        echo json_encode(['count' => $count]);
        exit;
    }

    if ($query === '') {
        $products = $productModel->getAllProducts($offset, $productsPerPage);
    } else {
        $products = $productModel->searchProductsByName($query, $offset, $productsPerPage);
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
