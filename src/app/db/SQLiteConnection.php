<?php
declare(strict_types=1);

namespace Src\app\db;
use PDO;

//Singleton db connection
class SQLiteConnection {
    private static $connection;
    
    public static function instance(): object {
        if (self::$connection == null) {
            self::$connection = new PDO('sqlite:bugsdb.db');
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
          return self::$connection;
    }
}