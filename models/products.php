<?php
require_once 'db.php';

class Product extends Db
{
    public function getAllProducts($offset = 0, $limit = 15)
    {
        $sql = self::$connection->prepare("SELECT * FROM products LIMIT ?, ?");
        $sql->bind_param("ii", $offset, $limit);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductsByCategory($category)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE category = ?");
        $sql->bind_param("s", $category);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalProductsCount()
    {
        $sql = self::$connection->prepare("SELECT COUNT(*) as count FROM products");
        $sql->execute();
        $result = $sql->get_result();
        $count = $result->fetch_assoc();

        return $count['count'];
    }

    public function searchProductsByName($query)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE productName LIKE ?");
        $searchTerm = '%' . $query . '%';
        $sql->bind_param("s", $searchTerm);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchProductsByNameAndGenre($query, $genre, $offset = 0, $limit = 15)
    {
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

    public function searchProductsByNameAndGenreCount($query, $genre)
    {
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

    public function getProductById($id)
    {
        $sql = self::$connection->prepare(
            "SELECT p.*, g.genreName 
             FROM products p
             JOIN genre g ON p.genreID = g.genreID
             WHERE p.id = ?"
        );
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_assoc();
    }

    public function getMostPopularGame()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY views DESC LIMIT 1");
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_assoc();
    }

    public function getNewestGameById()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 1");
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_assoc();
    }

    public function getTrendingGame()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY rates DESC LIMIT 1");
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_assoc();
    }

    public function getRandomGames($limit)
    {
        $sql = self::$connection->prepare(
            "SELECT * FROM products 
             ORDER BY RAND() 
             LIMIT ?"
        );
        $sql->bind_param("i", $limit);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteProduct($id)
    {
        $sql = self::$connection->prepare("DELETE FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }

    public function createProduct($productName, $price, $summary, $description, $genreID, $pictureName, $views, $rates)
    {
        $sql = self::$connection->prepare(
            "INSERT INTO products (picture, productName, price, summary, description, genreID, views, rates) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $sql->bind_param("ssdssiis", $pictureName, $productName, $price, $summary, $description, $genreID, $views, $rates);
        return $sql->execute();
    }

    public function getNextProductId()
    {
        $sql = self::$connection->prepare("
            SELECT MIN(t1.id + 1) AS nextId
            FROM products t1
            LEFT JOIN products t2 ON t1.id + 1 = t2.id
            WHERE t2.id IS NULL
        ");
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        return $row['nextId'] ?? 1;
    }

    public function updateProduct($productID, $productName, $price, $summary, $description, $genreID, $pictureName)
    {
        $sql = self::$connection->prepare(
            "UPDATE products 
             SET productName = ?, price = ?, summary = ?, description = ?, genreID = ?, picture = ? 
             WHERE id = ?"
        );
        $sql->bind_param("sdssisi", $productName, $price, $summary, $description, $genreID, $pictureName, $productID);
        return $sql->execute();
    }

    public function getAllProductsWithGenre()
    {
        $sql = self::$connection->prepare("
        SELECT p.id, p.productName, p.price, p.picture, g.genreName
        FROM products p
        LEFT JOIN genre g ON p.genreID = g.genreID
    ");
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPaginatedProducts($limit, $offset)
    {
        $query = "SELECT products.*, genre.genreName FROM products
                LEFT JOIN genre ON products.genreID = genre.genreID
                ORDER BY products.id DESC
                LIMIT ? OFFSET ?";
        $stmt = self::$connection->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ii", $limit, $offset);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function getTotalProducts()
    {
        $query = "SELECT COUNT(*) AS total FROM products";
        $result = self::$connection->query($query);
        return $result->fetch_assoc()['total'] ?? 0;
    }
}
