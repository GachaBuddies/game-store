<?php
class Data {
    public static $connection;

    public function __construct() {
        if (!self::$connection) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            self::$connection->set_charset(DB_CHARSET);
        }
        return self:$connection;
    }
}
?>
