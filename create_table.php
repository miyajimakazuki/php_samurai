<!DOCTYPE html>
<html lang="ja">
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
         $pdo = new PDO($dsn, $user, $password );

        // samuraiテーブル作成するためのSQLを変数sqlに代入
         $sql = 'CREATE TABLE IF NOT EXISTS samurai (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            furigana VARCHAR(60) NOT NULL;
            email VARCHAR(255) NOT NULL,
            age INT(11),
            address VARCHAR(255)
         )';
        //  SQL文の実行
        $dpo->query($sql);
         } catch (PDOException $e) {
            exit($e->getMessage());
         }



         echo 'データベースにテーブルを作成しました';
        ?>
    </p>
</body>
</html>
