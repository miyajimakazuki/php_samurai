<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_db</title>
</head>
<body>
    <p>
        <?php
         
         $dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
         $user = 'root';
         $password = 'root';
         $pdo = new PDO($dsn, $user, $password );
         echo 'データベースの接続に成功しました。';
        ?>
    </p>
</body>
</html>
