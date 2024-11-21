const genres = JSON.parse(document.getElementById('genre-data').textContent);
let displayedGenresCount = parseInt(document.getElementById('initial-genre-count').textContent, 10);
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
        parseInt(document.getElementById('initial-genre-count').textContent, 10);
    displayGenres();
    resetActiveFilter();
});

function resetActiveFilter() {
    document.querySelectorAll('.filter-btn.active').forEach(btn => btn.classList.remove('active'));
    gameCards.forEach(card => card.style.display = '');
}

displayGenres();

genreButtons.addEventListener('click', function(e) {
    if (e.target.classList.contains('filter-btn')) {
        const genre = e.target.getAttribute('data-genre');
        const searchQuery = searchBar.value.trim();

        const isActive = e.target.classList.contains('active');

        if (isActive) {
            e.target.classList.remove('active');
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('genre');
            window.history.pushState({}, '', '?' + urlParams.toString());
            fetchResults(searchQuery, '', 1);
        } else {
            e.target.classList.add('active');
            const urlParams = new URLSearchParams(window.location.search);
            if (genre) urlParams.set('genre', genre);
            if (searchQuery) urlParams.set('query', searchQuery);
            window.history.pushState({}, '', '?' + urlParams.toString());
            fetchResults(searchQuery, genre, 1);
        }
    }
});
