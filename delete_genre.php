<?php
require_once 'models/genre.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $genreModel = new Genre();
    $success = $genreModel->deleteGenre($id);

    if ($success) {
        header('Location: admin.php?tab=genres&message=Genre deleted successfully');
    } else {
        header('Location: admin.php?tab=genres&error=Failed to delete genre');
    }
    exit;
} else {
    header('Location: admin.php?tab=genres&error=Invalid input');
    exit;
}
