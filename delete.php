<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

if (isset($_GET['id'])) {
try {
    $pdo = new PDO($dsn, $user, $password);

    $sql = 'DELETE FROM samurai WHERE id = :id';
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    $stmt->execute();

    header('Location: select.php');

} catch (PDOException $e) {
    exit($e->getMessage());
}

} else {
    exit('idパラメータの値が存在しません。');
}