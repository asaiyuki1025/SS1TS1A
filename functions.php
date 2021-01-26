<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=LAA1211401-db;host=mysql149.phy.lolipop.lan';
    try {
        $pdo = new PDO($param, 'LAA1211401', 'trident');
        return $pdo;

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}
?>