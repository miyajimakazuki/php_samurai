<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

// ソート機能
try {
    $pdo = new PDO($dsn, $user, $password);
    $sql = 'SELECT * FROM samurai';
    
    $stmt = $pdo->query($sql);
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
        
    } else {
        $order = NULL;
    }

    // if (isset($_POST['keyword'])) {
    //     $keyword = $_POST['keyword'];

    // } else {
    //     $keyword = NULL;
    // }
    // // 検索窓
    // $sql = 'SELECT id, name, furigana, email, age, address FROM samurai WHERE furigana LIKE :keyword';
    // $stmt = $pdo->prepare($sql);
    
    // $partial_match = "%{$keyword}%";
    
    // $stmt->bindValue(':keyword', $partial_match, PDO::PARAM_STR);
    
    // $stmt->execute();

    // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    
    if ($order === 'asc') {
        $sql = 'SELECT id, name, furigana, email, age, address FROM samurai ORDER BY age ASC';
    } elseif ($order === 'desc') {
        $sql = 'SELECT id, name, furigana, email, age, address FROM samurai ORDER BY age DESC';
    } else {
        $sql = 'SELECT id, name, furigana, email, age, address FROM samurai ORDER BY id';
    }
    $stmt = $pdo->query($sql);
    
    // SQL文の実行結果を配列で取得する
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <!-- post 検索 -->
    <form method="post" action="select.php" class="search-form">
        <input type="text" placeholder="ふりがないれて" name="keyword">
        <input type="submit" value="ふりがなで検索">
    </form>

    <!-- order ソート -->
    <div class="sort">
        <a href="sort.php?order=asc" class="sort-btn">年齢順（昇順　ORDER=ASC）</a>
        <a href="sort.php?order=desc" class="sort-btn">年齢順（降順　ORDER=DESC）</a>
    </div>
    
    <table class="all_column">
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>ふりがな</th>
            <th>メールアドレス</th>
            <th>年齢</th>
            <th>住所</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
    <?php
        foreach ($results as $i => $result) {

            if($result['name'] == '大坪 ジローラモ')
        {
        $results[$i]['is_italian'] = 1;
        }
            // echo "<tr><td>{$result['name']}</td><td>{$result['furigana']}</td></tr>";
            $table_row = "
            <tr>
            <td>{$result['id']}</td>
            <td>{$result['name']}</td>
            <td>{$result['furigana']}</td>
            <td>{$result['email']}</td>
            <td>{$result['age']}</td>
            <td>{$result['address']}</td>
            <td><a href='update.php?id={$result['id']}'>このIDをresultした状態で編集へ！</a></td>
            <td><a href='delete.php?id={$result['id']}'>このIDをresultした状態で削除！</a></td>
            </tr>
            ";
            echo $table_row;

        }
        // print_r($results);
        ?>
        
    </table>

    <button type="submit" name="submit" value="insert"><a href="http://localhost:8888/php_samurai/insert.php">INSERT新規登録へ</a></button>

    
    
</body>
</html>