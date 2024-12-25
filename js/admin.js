function editGenre(id, name) {
    const newName = prompt("Edit Genre Name:", name);
    if (newName) {
        window.location.href = `edit_genre.php?id=${id}&name=${encodeURIComponent(newName)}`;
    }
}

function deleteGenre(id) {
    if (confirm("Are you sure you want to delete this genre?")) {
        window.location.href = `delete_genre.php?id=${id}`;
    }
}

function addGenre() {
    const name = prompt("New Genre Name:");
    if (name) {
        window.location.href = `create_genre.php?name=${encodeURIComponent(name)}`;
    }
}

function editProduct(id) {
    window.location.href = `edit_product.php?id=${id}`;
}

function deleteProduct(id) {
    if (confirm("Are you sure you want to delete this product?")) {
        window.location.href = `delete_product.php?id=${id}`;
    }
}

function addProduct() {
    window.location.href = `create_product.php`;
}

function showTab(tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    const buttons = document.querySelectorAll('.tab-button');

    tabs.forEach((tab) => {
        tab.classList.remove('active');
    });

    buttons.forEach((button) => {
        button.classList.remove('active');
    });

    document.getElementById(tabId).classList.add('active');
    document.querySelector(`button[onclick="showTab('${tabId}')"]`).classList.add('active');
}
