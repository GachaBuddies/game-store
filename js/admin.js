function editGenre(id, name) {
    const newName = prompt("Edit Genre Name:", name);
    if (newName) {
        window.location.href = `edit_genre.php?id=${id}&name=${encodeURIComponent(newName)}&active_tab=genres`;
    }
}

function deleteGenre(id) {
    if (confirm("Are you sure you want to delete this genre?")) {
        window.location.href = `delete_genre.php?id=${id}&active_tab=genres`;
    }
}

function addGenre() {
    const name = prompt("New Genre Name:");
    if (name) {
        window.location.href = `create_genre.php?name=${encodeURIComponent(name)}&active_tab=genres`;
    }
}

function editProduct(id) {
    window.location.href = `edit_product.php?id=${id}&active_tab=games`;
}

function deleteProduct(id) {
    if (confirm("Are you sure you want to delete this product?")) {
        window.location.href = `delete_product.php?id=${id}&active_tab=games`;
    }
}

function addProduct() {
    window.location.href = `create_product.php?active_tab=games`;
}

function showTab(tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.style.display = 'none');
    document.getElementById(tabId).style.display = 'block';
}
