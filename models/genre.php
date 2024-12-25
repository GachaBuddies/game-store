<?php
require_once 'db.php';

class Genre extends Db
{
    public function getAllGenres()
    {
        $sql = self::$connection->prepare("SELECT * FROM genre");
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateGenre($id, $name)
    {
        $query = "UPDATE genre SET genreName = ? WHERE genreID = ?";
        $stmt = self::$connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $name, $id);
            return $stmt->execute();
        }
        return false;
    }

    public function deleteGenre($id)
    {
        $query = "DELETE FROM genre WHERE genreID = ?";
        $stmt = self::$connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        return false;
    }

    public function addGenre($name)
    {
        $query = "INSERT INTO genre (genreName) VALUES (?)";
        $stmt = self::$connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $name);
            return $stmt->execute();
        }
        return false;
    }

    public function getPaginatedGenres($limit, $offset)
    {
        $query = "SELECT * FROM genre ORDER BY genreID DESC LIMIT ? OFFSET ?";
        $stmt = self::$connection->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ii", $limit, $offset);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function getTotalGenres()
    {
        $query = "SELECT COUNT(*) AS total FROM genre";
        $result = self::$connection->query($query);
        return $result->fetch_assoc()['total'] ?? 0;
    }
}
