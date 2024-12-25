<?php
require_once 'models/genre.php';

if (isset($_GET['id'], $_GET['name']) && is_numeric($_GET['id']) && !empty(trim($_GET['name']))) {
    $id = intval($_GET['id']);
    $name = trim($_GET['name']);

    $genreModel = new Genre();
    $success = $genreModel->updateGenre($id, $name);

    if ($success) {
        header('Location: admin.php?tab=genres&message=Genre updated successfully');
    } else {
        header('Location: admin.php?tab=genres&error=Failed to update genre');
    }
    exit;
} else {
    header('Location: admin.php?tab=genres&error=Invalid input');
    exit;
}
