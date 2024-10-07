<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);
        // echo 1;

        $sql = '
        INSERT INTO samurai (name, furigana, email, age, address)
        VALUES (:name, :furigana, :email, :age, :address)
        ';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $_POST['samurai_name'], PDO::PARAM_STR);
        $stmt->bindValue(':furigana', $_POST['samurai_furigana'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $_POST['samurai_email'], PDO::PARAM_STR);
        $stmt->bindValue(':age', $_POST['samurai_age'], PDO::PARAM_INT);
        $stmt->bindValue(':address', $_POST['samurai_address'], PDO::PARAM_STR);
        
        $stmt->execute();

        header('Location: select.php');
        

    } catch (PDOException $e) {
        exit($e->getMessage());
    }

}
// echo 1;

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>PHP_SAMURAI</title>
</head>
<body>
    <h1>ユーザー登録</h1>
    <p>ユーザー情報を入力してください。</p>
   

    <form method="post" action="insert.php">
        <div>
            <label for="samurai_name">お名前<span>【必須】</span></label>
            <input type="text" id="samurai_name" name="samurai_name" maxlength="60" required >

            <label for="samurai_furigana">ふりがな<span>【必須】</span></label>
            <input type="text" id="samurai_furigana" name="samurai_furigana" maxlength="60" required >

            <label for="samurai_email">メールアドレス<span>【必須】</span></label>
            <input type="email" id="samurai_email" name="samurai_email" maxlength="255" required >

            <label for="samurai_age">年齢</label>
            <input type="number" id="samurai_age" name="samurai_age" min="13" max="130">

            <label for="samurai_address">住所</label>
            <input type="text" id="samurai_address" name="samurai_address" maxlength="255">
    </div>
    <button type="submit" name="submit" value="insert">登録</button>
    
    
    </form>

    <button type="submit" name="submit" value="insert"><a href="http://localhost:8888/php_samurai/select.php">SELECT一覧へ</a></button>

</body>
</html>
