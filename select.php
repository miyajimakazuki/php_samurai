<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $user, $password);
    $sql = 'SELECT name, furigana FROM samurai';
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
    <link rel="stylesheet"  href="css/style.css">
    <title>PHP_SAMURAI</title>
</head>
<body>
<form method="get" action="select.php" class="search-form">
        <input type="text" placeholder="ふりがないれて" name="keyword">
        <input type="submit" value="検索">
    </form>
    
    <table>
        <tr>
            <th>氏名</th>
            <th>ふりがな</th>
        </tr>
    <?php
        foreach ($results as $i => $result) {

            if($result['name'] == '大坪 ジローラモ')
        {
        $results[$i]['is_italian'] = 1;
        }
            echo "<tr><td>{$result['name']}</td><td>{$result['furigana']}</td></tr>";
        }
        // print_r($results);
        ?>
        
    </table>

    <button type="submit" name="submit" value="insert"><a href="http://localhost:8888/php_samurai/insert.php">INSERT登録へ</a></button>

    
    
</body>
</html>