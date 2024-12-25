<?php
session_start();
require_once 'models/products.php';
require_once 'models/genre.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$productID = $_GET['id'] ?? null;
if (!$productID) {
    header('Location: index.php');
    exit();
}

$productModel = new Product();
$product = $productModel->getProductById($productID);
if (!$product) {
    header('Location: index.php');
    exit();
}

$genreModel = new Genre();
$genres = $genreModel->getAllGenres();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'] ?? '';
    $price = $_POST['price'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $description = $_POST['description'] ?? '';
    $genreID = $_POST['genreID'] ?? '';
    $picture = $_FILES['picture'] ?? null;

    if ($productName && $price && $summary && $description && $genreID) {
        $pictureName = $product['picture'];

        if ($picture && $picture['tmp_name']) {
            $targetPath = "images/" . $pictureName;
            if (file_exists($targetPath)) {
                unlink($targetPath);
            }
            move_uploaded_file($picture['tmp_name'], $targetPath);
        }

        if ($productModel->updateProduct($productID, $productName, $price, $summary, $description, $genreID, $pictureName)) {
            header('Location: admin.php');
            exit();
        }        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/create_edit.css?">
    <title>Edit Product</title>
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
        <h2 class="form-header">Edit Product</h2>

        <form class="product-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" value="<?php echo $product['productName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price (USD):</label>
                <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="summary">Summary:</label>
                <textarea id="summary" name="summary" rows="3" required><?php echo $product['summary']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="5" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <select id="genre" name="genreID" required>
                    <option value="">Select Genre</option>
                    <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['genreID']; ?>" <?php echo $genre['genreID'] == $product['genreID'] ? 'selected' : ''; ?>>
                        <?php echo $genre['genreName']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="picture">Game Picture:</label>
                <img src="images/<?php echo $product['picture']; ?>" alt="Current Picture" style="width: 150px; height: auto; margin-bottom: 10px;">
                <input type="file" id="picture" name="picture" accept="image/*">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-choose">Update Product</button>
                <button type="reset" class="btn btn-choose">Reset</button>
            </div>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Game Store - Group 4. All rights reserved.</p>
    </footer>
</body>

</html>
