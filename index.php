<?php
require_once 'models/products.php';
require_once 'models/genre.php';

$productModel = new Product();
$genreModel = new Genre();

$productsPerPage = 15;

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $productsPerPage;

$products = $productModel->getAllProducts($offset, $productsPerPage);
$genres = $genreModel->getAllGenres();

$totalProducts = $productModel->getTotalProductsCount();
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
        <a href="index.php"><h1>Game Store</h1></a>
        <div class="navbar-right">
            <input type="text" placeholder="Search games...">
            <button class="btn">Cart</button>
            <button class="btn">Login</button>
            <button class="btn">Register</button>
        </div>
    </header>

    <main class="container">
        <div class="filter-container">
            <div class="filter-buttons" id="genre-buttons">
                <?php foreach (array_slice($genres, 0, $initialGenreCount) as $genre): ?>
                    <button class="filter-btn"><?php echo $genre['genreName']; ?></button>
                <?php endforeach; ?>
            </div>
            <?php if ($showMore): ?>
                <button id="load-more-btn" class="btn">Load More</button>
            <?php endif; ?>
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

        <h2>Featured Games</h2>
        <div class="game-grid">
            <?php foreach ($products as $product): ?>
                <div class="game-card">
                    <img src="<?php echo $product['picture']; ?>" alt="Game Thumbnail">
                    <div class="content">
                        <h2><?php echo $product['productName']; ?></h2>
                        <p>
                            <?php
                                $description = $product['description'];
                                echo strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                            ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

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
    </main>

    <footer class="footer">
        <p>&copy; 2024 Game Store - Group 4. All rights reserved.</p>
    </footer>

    <script>
        const genres = <?php echo json_encode($genres); ?>;
        let displayedGenresCount = <?php echo $initialGenreCount; ?>;
        const genreButtons = document.getElementById('genre-buttons');
        const loadMoreBtn = document.getElementById('load-more-btn');

        function displayGenres() {
            genreButtons.innerHTML = '';
            const displayedGenres = genres.slice(0, displayedGenresCount);
            displayedGenres.forEach(genre => {
                const button = document.createElement('button');
                button.className = 'filter-btn';
                button.textContent = genre.genreName;
                genreButtons.appendChild(button);
            });
        }

        loadMoreBtn.addEventListener('click', function() {
            if (displayedGenresCount < genres.length) {
                displayedGenresCount = genres.length;
                displayGenres();
                this.textContent = "Load Less";
            } else {
                displayedGenresCount = <?php echo $initialGenreCount; ?>;
                displayGenres();
                this.textContent = "Load More";
            }
        });

        displayGenres();
    </script>

</body>
</html>
