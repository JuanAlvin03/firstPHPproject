<?php
    $host = 'localhost';
    $db   = 'backendproject';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

   /* $db   = 'id19947799_backendproject';
    $user = 'id19947799_root';
    $pass = '-NM=kq<{=l6d(BUW';*/

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = null;
    try {
        $db = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>