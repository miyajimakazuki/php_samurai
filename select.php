<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $user, $password);
    $sql = 'select id, name, email FROM samurai';
    // $pdo->query($sql);
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($results);
} catch (PDOException $e) {
    exit($e->getMessage());

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_SAMURAI</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>メールアドレス</th>
        </tr>
    <?php
        foreach ($results as $result) {
            echo "<tr><td>{$result['id']}</td><td>{$result['name']}</td><td>{$result['email']}</td></tr>";
        }
        ?>
    </table>
    
    
</body>
</html>