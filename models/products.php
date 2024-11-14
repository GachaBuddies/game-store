<?php
require_once 'db.php';

class Product extends Db {
    public function getAllProducts($offset = 0, $limit = 15) {
        $sql = self::$connection->prepare("SELECT * FROM products LIMIT ?, ?");
        $sql->bind_param("ii", $offset, $limit);
        $sql->execute();
        $result = $sql->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);
    
        return $products;
    }    

    public function getProductsByCategory($category) {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE category = ?");
        $sql->bind_param("s", $category);
        $sql->execute();
        $result = $sql->get_result();
        $product = $result->fetch_all(MYSQLI_ASSOC);

        return $product;
    }

    public function getTotalProductsCount() {
        $sql = self::$connection->prepare("SELECT COUNT(*) as count FROM products");
        $sql->execute();
        $result = $sql->get_result();
        $count = $result->fetch_assoc();
    
        return $count['count'];
    }

    public function searchProductsByName($query) {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE productName LIKE ?");
        $searchTerm = '%' . $query . '%';
        $sql->bind_param("s", $searchTerm);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchProductsByNameAndGenre($query, $genre, $offset = 0, $limit = 15) {
        if ($genre) {
            $sql = self::$connection->prepare(
                "SELECT p.* 
                 FROM products p
                 JOIN genre g ON p.genreID = g.genreID
                 WHERE p.productName LIKE ? AND g.genreName = ?
                 LIMIT ?, ?"
            );
            $searchTerm = '%' . $query . '%';
            $sql->bind_param("ssii", $searchTerm, $genre, $offset, $limit);
        } else {
            $sql = self::$connection->prepare(
                "SELECT * FROM products 
                 WHERE productName LIKE ?
                 LIMIT ?, ?"
            );
            $searchTerm = '%' . $query . '%';
            $sql->bind_param("sii", $searchTerm, $offset, $limit);
        }
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function searchProductsByNameAndGenreCount($query, $genre) {
        if ($genre) {
            $sql = self::$connection->prepare(
                "SELECT COUNT(*) as count
                 FROM products p
                 JOIN genre g ON p.genreID = g.genreID
                 WHERE p.productName LIKE ? AND g.genreName = ?"
            );
            $searchTerm = '%' . $query . '%';
            $sql->bind_param("ss", $searchTerm, $genre);
        } else {
            $sql = self::$connection->prepare(
                "SELECT COUNT(*) as count 
                 FROM products 
                 WHERE productName LIKE ?"
            );
            $searchTerm = '%' . $query . '%';
            $sql->bind_param("s", $searchTerm);
        }
        $sql->execute();
        $result = $sql->get_result();
        $count = $result->fetch_assoc();
        return $count['count'];
    }    
}
?>
