<?php
session_start();

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
            <button class="btn" onclick="window.location.href='cart.php';">Cart</button>

            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                    <button class="btn" onclick="window.location.href='admin.php';">Product Manage</button>
                <?php endif; ?>
                <button class="btn" onclick="window.location.href='logout.php';">Logout</button>
            <?php else: ?>
                <button class="btn" onclick="window.location.href='login.php';">Login</button>
                <button class="btn" onclick="window.location.href='register.php';">Register</button>
            <?php endif; ?>
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

        <h2 class="featured-games">Featured Games</h2>
        <div id="search-results" class="game-grid">
            <?php foreach ($products as $product): ?>
                <a href="productdetail.php?id=<?php echo $product['id']; ?>" class="game-card-link">
                    <div class="game-card">
                        <img src="images/<?php echo $product['picture']; ?>?t=<?php echo time(); ?>"
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
                                <?php echo $product['summary']; ?>
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

    <script>
        //Genre JavaScript
        const genres = <?php echo json_encode($genres); ?>;
        let displayedGenresCount = <?php echo $initialGenreCount; ?>;
        const genreButtons = document.getElementById('genre-buttons');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const gameCards = document.querySelectorAll('.game-card');

        function displayGenres() {
            genreButtons.innerHTML = '';
            const displayedGenres = genres.slice(0, displayedGenresCount);
            displayedGenres.forEach(genre => {
                const button = document.createElement('button');
                button.className = 'filter-btn';
                button.textContent = genre.genreName;
                button.setAttribute('data-genre', genre.genreName);
                genreButtons.appendChild(button);
            });
            genreButtons.appendChild(loadMoreBtn);
            loadMoreBtn.textContent = (displayedGenresCount < genres.length) ? "Load More" : "Load Less";
        }

        loadMoreBtn.addEventListener('click', function() {
            displayedGenresCount = (displayedGenresCount < genres.length) ? genres.length :
                <?php echo $initialGenreCount; ?>;
            displayGenres();
            resetActiveFilter();
        });

        function resetActiveFilter() {
            document.querySelectorAll('.filter-btn.active').forEach(btn => btn.classList.remove('active'));
            gameCards.forEach(card => card.style.display = '');
        }

        displayGenres();

        genreButtons.addEventListener('click', function(e) {
            if (e.target.classList.contains('filter-btn') && !e.target.id.includes('load-more-btn')) {
                const isActive = e.target.classList.contains('active');
                const genre = e.target.getAttribute('data-genre');
                const searchQuery = searchBar.value.trim();

                if (isActive) {
                    e.target.classList.remove('active');

                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.delete('genre');
                    if (searchQuery) {
                        urlParams.set('query', searchQuery);
                    }
                    urlParams.set('page', 1);
                    window.history.pushState({}, '', '?' + urlParams.toString());

                    fetchResults(searchQuery, '', 1);
                } else {
                    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));

                    e.target.classList.add('active');

                    const urlParams = new URLSearchParams(window.location.search);
                    if (genre) urlParams.set('genre', genre);
                    if (searchQuery) urlParams.set('query', searchQuery);
                    urlParams.set('page', 1);
                    window.history.pushState({}, '', '?' + urlParams.toString());

                    fetchResults(searchQuery, genre, 1);
                }
            }
        });

        function fetchResults() {
            const urlParams = new URLSearchParams(window.location.search);
            const query = urlParams.get('query') || '';
            const genre = urlParams.get('genre') || '';

            fetch(`search.php?query=${encodeURIComponent(query)}&genre=${encodeURIComponent(genre)}&page=1`)
                .then(response => response.text())
                .then(data => {
                    gameGrid.innerHTML = data;
                    updatePagination(query, 1);
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script>
        //Searching JavaScript
        const searchBar = document.getElementById('search-bar');
        const gameGrid = document.querySelector('.game-grid');
        const paginationContainer = document.querySelector('.pagination');

        searchBar.addEventListener('input', () => {
            const query = searchBar.value.trim();
            const selectedGenre = document.querySelector('.filter-btn.active')?.textContent || '';
            const urlParams = new URLSearchParams(window.location.search);

            if (query === "") {
                urlParams.delete('query');
                urlParams.set('page', 1);
            } else {
                urlParams.set('query', query);
                urlParams.set('page', 1);
            }

            if (selectedGenre) {
                urlParams.set('genre', selectedGenre);
            } else {
                urlParams.delete('genre');
            }

            window.history.pushState({}, '', '?' + urlParams.toString());

            fetchResults(query, selectedGenre, 1);
        });

        function fetchResults(query, genre, page = 1) {
            fetch(`search.php?query=${encodeURIComponent(query)}&genre=${encodeURIComponent(genre)}&page=${page}`)
                .then(response => response.text())
                .then(data => {
                    gameGrid.innerHTML = data;
                    updatePagination(query, genre, page);
                })
                .catch(error => console.error('Error:', error));
        }

        function updatePagination(query, genre, currentPage = 1) {
            fetch(`search.php?query=${encodeURIComponent(query)}&genre=${encodeURIComponent(genre)}&count=true`)
                .then(response => response.json())
                .then(data => {
                    const totalProducts = data.count;
                    const totalPages = Math.ceil(totalProducts / <?php echo $productsPerPage; ?>);
                    paginationContainer.innerHTML = '';

                    if (totalProducts > <?php echo $productsPerPage; ?>) {
                        if (currentPage > 1) {
                            paginationContainer.innerHTML +=
                                `<a class="page-btn" href="#" onclick="fetchResults('${query}', '${genre}', ${currentPage - 1})">Previous</a>`;
                        }

                        for (let i = 1; i <= totalPages; i++) {
                            paginationContainer.innerHTML +=
                                `<a class="page-btn ${i == currentPage ? 'active' : ''}" href="#" onclick="fetchResults('${query}', '${genre}', ${i})">${i}</a>`;
                        }

                        if (currentPage < totalPages) {
                            paginationContainer.innerHTML +=
                                `<a class="page-btn" href="#" onclick="fetchResults('${query}', '${genre}', ${currentPage + 1})">Next</a>`;
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="js/slider.js"></script>
</body>

</html>