<?php

namespace Model;

use PDO;
use PDOException;

class Database
{
    public static string $dbname = 'employees';
    public static string $user = 'root';
    public static string $password = 'Debian2022';
    public static string $table = "";
    public static object $dbh;


    public static function connection(): void
    {
        // Con un el método PDO::setAttribute
        try {
            $dsn = "mysql:host=localhost;dbname=" . self::$dbname;
            static::$dbh = new PDO($dsn, self::$user, self::$password);
            static::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function all(): array
    {
        $stmt = static::$dbh->prepare("SELECT * FROM " . static::$table . " LIMIT 100");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}
