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
}
?>
