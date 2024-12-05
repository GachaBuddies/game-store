<?php
session_start();
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
    <link rel="stylesheet" href="css/styles.css?">
</head>

<body>
    <header class="navbar">
        <a href="index.php">
            <h1>Game Store</h1>
        </a>
        <div class="navbar-right">
            <input type="text" id="search-bar" placeholder="Search games..." />
            <button class="btn" onclick="window.location.href='cart.php';">Cart</button>

            <?php if (isset($_SESSION['user'])): ?>
            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
            <button class="btn" onclick="window.location.href='create_product.php';">Create Product</button>
            <?php endif; ?>
            <button class="btn" onclick="window.location.href='logout.php';">Logout</button>
            <?php else: ?>
            <button class="btn" onclick="window.location.href='login.php';">Login</button>
            <button class="btn" onclick="window.location.href='register.php';">Register</button>
            <?php endif; ?>
        </div>
    </header>

    <main class="container">
        <div class="product-detail">
            <div class="product-image">
                <img src="images/<?php echo $product['picture']; ?>?t=<?php echo time(); ?>" alt="Product Image">
            </div>

            <div class="product-info">
                <h2><?php echo $product['productName']; ?></h2>
                <h3 class="price">
                    <?php echo $product['price'] == 0 ? 'Free' : '$' . $product['price']; ?>
                </h3>
                <h3>Description:</h3>
                <p><?php echo nl2br($product['description']); ?></p>

                <div class="product-details">
                    <p><strong>Genre:</strong> <?php echo $product['genreName']; ?></p>
                    <p><strong>Views:</strong> <?php echo $product['views']; ?></p>
                    <p><strong>Rating:</strong> <?php echo $product['rates']; ?>/10</p>
                </div>

                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="add_to_cart" class="btn-add-to-cart">Add to Cart</button>
                </form>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                <div class="admin-actions">
                    <button class="btn-edit"
                        onclick="window.location.href='edit_product.php?id=<?php echo $product['id']; ?>'">Edit</button>
                    <form method="POST" action="delete_product.php">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="btn-remove">Delete</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Game Store - Group 4. All rights reserved.</p>
    </footer>
</body>

</html>