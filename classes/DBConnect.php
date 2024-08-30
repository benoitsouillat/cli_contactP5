<?php

class DBConnect
{
    const DB_NAME = "openclassrooms";
    const DB_HOST = "db";
    const DB_PORT = 3306;
    const DB_USER = "admin";
    const DB_PASSWORD = "password";

    private static $pdo = null;
    public static function getPDO()
    {
        return self::$pdo === null ? new PDO(sprintf("mysql:dbname=%s;host=%s;port=%s;user=%s;password=%s", self::DB_NAME, self::DB_HOST, self::DB_PORT, self::DB_USER, self::DB_PASSWORD)) : self::$pdo;
    }
}
