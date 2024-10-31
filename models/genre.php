<?php
require_once 'db.php';

class Genre extends Db {
    public function getAllGenres() {
        $sql = self::$connection->prepare("SELECT * FROM genre");
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>