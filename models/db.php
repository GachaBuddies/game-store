<?php
require_once 'config.php';

class Db {
    public static $connection;

    public function __construct() {
        if (!self::$connection) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
            self::$connection->set_charset(DB_CHARSET);
        }
        return self::$connection;
    }
}
?>
