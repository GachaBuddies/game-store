<?php
require_once 'models/genre.php';

if (isset($_GET['name']) && !empty(trim($_GET['name']))) {
    $name = trim($_GET['name']);

    $genreModel = new Genre();
    $success = $genreModel->addGenre($name);

    if ($success) {
        header('Location: admin.php?tab=genres&message=Genre added successfully');
    } else {
        header('Location: admin.php?tab=genres&error=Failed to add genre');
    }
    exit;
} else {
    header('Location: admin.php?tab=genres&error=Invalid input');
    exit;
}
