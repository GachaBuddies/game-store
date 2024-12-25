<?php
session_start();

require_once 'models/products.php';
require_once 'models/genre.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$productModel = new Product();
$genreModel = new Genre();

$genres = $genreModel->getAllGenres();
$products = $productModel->getAllProductsWithGenre();

$genresPerPage = 15;
$productsPerPage = 15;

$currentGenrePage = isset($_GET['genre_page']) ? (int)$_GET['genre_page'] : 1;
$currentProductPage = isset($_GET['product_page']) ? (int)$_GET['product_page'] : 1;

$genreOffset = ($currentGenrePage - 1) * $genresPerPage;
$productOffset = ($currentProductPage - 1) * $productsPerPage;

$genres = $genreModel->getPaginatedGenres($genresPerPage, $genreOffset);
$totalGenres = $genreModel->getTotalGenres();
$totalGenrePages = ceil($totalGenres / $genresPerPage);

$products = $productModel->getPaginatedProducts($productsPerPage, $productOffset);
$totalProducts = $productModel->getTotalProducts();
$totalProductPages = ceil($totalProducts / $productsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <header class="navbar">
        <a href="index.php">
            <h1>Game Store</h1>
        </a>
        <div class="navbar-right">
            <button onclick="window.location.href='index.php';" class="btn back-to-store">Back to Store</button>
            <button class="btn" onclick="window.location.href='cart.php';">Cart</button>

            <?php if (isset($_SESSION['user'])): ?>
                <button class="btn" onclick="window.location.href='logout.php';">Logout</button>
            <?php else: ?>
                <button class="btn" onclick="window.location.href='login.php';">Login</button>
                <button class="btn" onclick="window.location.href='register.php';">Register</button>
            <?php endif; ?>
        </div>
    </header>

    <main>
        <div class="tabs">
            <button class="btn" onclick="showTab('genres')">Manage Genres</button>
            <button class="btn" onclick="showTab('games')">Manage Games</button>
        </div>

        <section id="genres" class="tab-content">
            <h2>Manage Genres</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Genre Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($genres as $genre): ?>
                        <tr>
                            <td><?php echo $genre['genreID']; ?></td>
                            <td><?php echo $genre['genreName']; ?></td>
                            <td>
                                <button onclick="editGenre(<?php echo $genre['genreID']; ?>, '<?php echo $genre['genreName']; ?>');" class="btn-other">Edit</button>
                                <button onclick="deleteGenre(<?php echo $genre['genreID']; ?>);" class="btn-other">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php for ($i = 1; $i <= $totalGenrePages; $i++): ?>
                    <a class="page-btn" href="?genre_page=<?php echo $i; ?>&product_page=<?php echo $currentProductPage; ?>" class="<?php echo ($i == $currentGenrePage) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>

            <button onclick="addGenre();" class="btn-other">Add New Genre</button>
        </section>

        <section id="games" class="tab-content">
            <h2>Manage Games</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Picture</th>
                        <th>Game Name</th>
                        <th>Price</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><img src="images/<?php echo $product['picture']; ?>" alt="Game Image" style="width: 100px; height: auto;"></td>
                            <td><?php echo $product['productName']; ?></td>
                            <td><?php echo $product['price']; ?> USD</td>
                            <td><?php echo $product['genreName'] ?? 'N/A'; ?></td>
                            <td>
                                <button onclick="editProduct(<?php echo $product['id']; ?>);" class="btn-other">Edit</button>
                                <button onclick="deleteProduct(<?php echo $product['id']; ?>);" class="btn-other">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php for ($i = 1; $i <= $totalProductPages; $i++): ?>
                    <a class="page-btn" href="?product_page=<?php echo $i; ?>&genre_page=<?php echo $currentGenrePage; ?>" class="<?php echo ($i == $currentProductPage) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>

            <button onclick="addProduct()" class="btn-other">Add New Product</button>
        </section>
    </main>

    <script src="js/admin.js"></script>
</body>

</html>