<?php

/* MySQLi database connection.
 */

/**
 * @host localhost
 * @user admin
 * @pass 12345
 * @database messageboard
 */
class DbConnection extends mysqli {

    private static $link = null;

    private function __construct() {
        
    }

    public static function dbConnect() {
        if (self::$link == null) {
            self::$link = new DbConnection();
            self::$link->mysqli('localhost', 'admin', '12345', 'books_pro');
            mysqli_set_charset(self::$link, 'utf8');
        }
        return self::$link;
    }

}

?>