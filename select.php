<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_SAMURAI</title>
</head>
<body>
    <p>
        <?php
        $dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
        $user = 'root';
        $password = 'root';

        try {
            $pdo = new PDO($dsn, $user, $password);
            $sql = 'select id, name FROM samurai';
            // $pdo->query($sql);
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            print_r($results);
        } catch (PDOException $e) {
            exit($e->getMessage());

        }
        
        echo 'データベースsamuraiからidと名前すべて検索しました';
        ?>
    </p>
</body>
</html>