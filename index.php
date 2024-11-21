<?php
require_once 'models/products.php';
require_once 'models/genre.php';

$productModel = new Product();
$genreModel = new Genre();

$productsPerPage = 15;

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = $currentPage < 1 ? 1 : $currentPage;
$offset = ($currentPage - 1) * $productsPerPage;

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

$mostPopular = $productModel->getMostPopularGame();
$newest = $productModel->getNewestGameById();
$trending = $productModel->getTrendingGame();

$randomGames = $productModel->getRandomGames(2);

if ($query === '') {
    $products = $productModel->getAllProducts($offset, $productsPerPage);
} else {
    $products = $productModel->searchProductsByName($query);
}

$genres = $genreModel->getAllGenres();
$totalProducts = $query === '' ? $productModel->getTotalProductsCount() : count($products);
$totalPages = ceil($totalProducts / $productsPerPage);

$initialGenreCount = 13;
$totalGenres = count($genres);
$showMore = $totalGenres > $initialGenreCount;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header class="navbar">
        <a href="index.php">
            <h1>Game Store</h1>
        </a>
        <div class="navbar-right">
            <input type="text" id="search-bar" placeholder="Search games..." />
            <button class="btn">Cart</button>
            <button class="btn" onclick="window.location.href='login.php';">Login</button>
            <button class="btn" onclick="window.location.href='register.php';">Register</button>
        </div>
    </header>

    <main class="container">
        <div class="featured-section box-header">
            <div class="featured-left">
                <div class="slider">
                    <div class="slides">
                        <a href="productdetail.php?id=<?php echo $mostPopular['id']; ?>" class="slide">
                            <div class="overlay"></div>
                            <img src="images/<?php echo $mostPopular['picture']; ?>"
                                alt="<?php echo $mostPopular['productName']; ?>">
                            <div class="slide-content">
                                <h3 class="slider-title">Most Popular</h3>
                                <h2><?php echo $mostPopular['productName']; ?></h2>
                            </div>
                        </a>

                        <a href="productdetail.php?id=<?php echo $newest['id']; ?>" class="slide">
                            <div class="overlay"></div>
                            <img src="images/<?php echo $newest['picture']; ?>"
                                alt="<?php echo $newest['productName']; ?>">
                            <div class="slide-content">
                                <h3 class="slider-title">Newest</h3>
                                <h2><?php echo $newest['productName']; ?></h2>
                            </div>
                        </a>

                        <a href="productdetail.php?id=<?php echo $trending['id']; ?>" class="slide">
                            <div class="overlay"></div>
                            <img src="images/<?php echo $trending['picture']; ?>"
                                alt="<?php echo $trending['productName']; ?>">
                            <div class="slide-content">
                                <h3 class="slider-title">Most Trending</h3>
                                <h2><?php echo $trending['productName']; ?></h2>
                            </div>
                        </a>
                    </div>
                    <div class="controls">
                        <span class="prev slider-nav left">&#10094;</span>
                        <span class="next slider-nav right">&#10095;</span>
                    </div>
                </div>
            </div>
            <div class="featured-right">
                <?php foreach ($randomGames as $randomGame): ?>
                <a href="productdetail.php?id=<?php echo $randomGame['id']; ?>" class="random-game-link">
                    <div class="random-game">
                        <div class="overlay"></div>
                        <img src="images/<?php echo $randomGame['picture']; ?>"
                            alt="<?php echo $randomGame['productName']; ?>">
                        <div class="random-game-content">
                            <h2><?php echo $randomGame['productName']; ?></h2>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="filter-container">
            <div class="filter-buttons" id="genre-buttons">
                <?php foreach (array_slice($genres, 0, $initialGenreCount) as $genre): ?>
                <button class="filter-btn"><?php echo $genre['genreName']; ?></button>
                <?php endforeach; ?>

                <?php if ($showMore): ?>
                <button id="load-more-btn" class="btn">Load More</button>
                <?php endif; ?>
            </div>
        </div>

        <div class="sort-dropdown">
            <label for="sort">Sort by:</label>
            <select id="sort">
                <option value="popular">Most Popular</option>
                <option value="newest">Newest</option>
                <option value="rating">Top Rated</option>
                <option value="price_low_high">Price: Low to High</option>
                <option value="price_high_low">Price: High to Low</option>
            </select>
        </div>

        <h2 class="featured-games">Featured Games</h2>
        <div id="search-results" class="game-grid">
            <?php foreach ($products as $product): ?>
            <a href="productdetail.php?id=<?php echo $product['id']; ?>" class="game-card-link">
                <div class="game-card">
                    <img src="images/<?php echo $product['picture']; ?>"
                        alt="<?php echo $product['productName']; ?> Thumbnail">
                    <div class="content">
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
                        <p>
                            <?php
                                    $description = $product['description'];
                                    echo strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                                ?>
                        </p>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <?php if ($totalProducts > $productsPerPage): ?>
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
            <a class="page-btn" href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="page-btn <?php echo ($i == $currentPage) ? 'active' : ''; ?>" href="?page=<?php echo $i; ?>">
                <?php echo $i; ?>
            </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
            <a class="page-btn" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Game Store - Group 4. All rights reserved.</p>
    </footer>

    <script src="js/genre.js"></script>
    <script src="js/search.js"></script>
    <script src="js/slider.js"></script>
</body>

</html>