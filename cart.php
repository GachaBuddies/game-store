<?php
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalPrice = array_sum(array_column($cart, 'price'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Game Store</title>
    <link rel="stylesheet" href="css/cart.css">
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
        <div class="cart">
            <h2>Shopping Cart</h2>
            <div class="cart-items">
                <?php foreach ($cart as $item): ?>
                <?php if (isset($item['id']) && isset($item['name']) && isset($item['price']) && isset($item['picture'])): ?>
                <div class="cart-item">
                    <img src="images/<?php echo ($item['picture']); ?>" alt="<?php echo ($item['name']); ?>">
                    <div class="cart-item-info">
                        <h3><?php echo ($item['name']); ?></h3>
                        <p>Price: $<?php echo ($item['price']); ?></p>
                    </div>
                    <form method="POST" action="remove_from_cart.php">
                        <input type="hidden" name="product_id" value="<?php echo ($item['id']); ?>">
                        <button type="submit" class="btn-remove">Remove</button>
                    </form>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="cart-total">
                Total: $<?php echo number_format($totalPrice, 2); ?>
            </div>
            <div class="cart-actions">
                <form method="POST" action="clear_cart.php">
                    <button type="submit" class="btn-other">Checkout</button>
                </form>
                <button onclick="window.location.href='index.php';" class="btn-other">Continue Shopping</a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Game Store - Group 4. All rights reserved.</p>
    </footer>
</body>

</html>
