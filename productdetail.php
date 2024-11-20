<?php
require_once 'models/products.php';

$productModel = new Product();

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($productId <= 0) {
    header('Location: index.php');
    exit();
}

$product = $productModel->getProductById($productId);

if (!$product) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['productName']; ?> - Game Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="navbar">
        <a href="index.php"><h1>Game Store</h1></a>
        <div class="navbar-right">
            <input type="text" id="search-bar" placeholder="Search games..." />
            <button class="btn">Cart</button>
            <button class="btn">Login</button>
            <button class="btn">Register</button>
        </div>
    </header>

    <main class="container">
        <div class="product-detail">
            <div class="product-image">
                <img src="images/<?php echo $product['picture']; ?>" alt="Product Image">
            </div>

            <div class="product-info">
                <h2><?php echo $product['productName']; ?></h2>
                <h3 class="price">
                    <?php
                        if ($product['price'] == 0) {
                            echo 'Free';
                        } else {
                            echo '$' . $product['price'];
                        }
                    ?>
                </h3>
                <h3>Description:</h3>
                <p><?php echo $product['description']; ?></p>

                <div class="product-details">
                    <p><strong>Genre:</strong> <?php echo $product['genreName']; ?></p>
                    <p><strong>Views:</strong> <?php echo $product['views']; ?></p>
                    <p><strong>Rating:</strong> <?php echo $product['rates']; ?>/10</p>
                </div>

                <button class="btn-add-to-cart">Add to Cart</button>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Game Store - Group 4. All rights reserved.</p>
    </footer>
</body>
</html>
