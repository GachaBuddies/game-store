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
            const totalPages = Math.ceil(totalProducts / parseInt(document.getElementById('products-per-page').textContent, 10));
            paginationContainer.innerHTML = '';

            if (totalProducts > parseInt(document.getElementById('products-per-page').textContent, 10)) {
                if (currentPage > 1) {
                    paginationContainer.innerHTML += `<a class="page-btn" href="#" onclick="fetchResults('${query}', '${genre}', ${currentPage - 1})">Previous</a>`;
                }

                for (let i = 1; i <= totalPages; i++) {
                    paginationContainer.innerHTML += `<a class="page-btn ${i == currentPage ? 'active' : ''}" href="#" onclick="fetchResults('${query}', '${genre}', ${i})">${i}</a>`;
                }

                if (currentPage < totalPages) {
                    paginationContainer.innerHTML += `<a class="page-btn" href="#" onclick="fetchResults('${query}', '${genre}', ${currentPage + 1})">Next</a>`;
                }
            }
        })
        .catch(error => console.error('Error:', error));
}
