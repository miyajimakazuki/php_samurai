<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);

        // 動的に変わる値をプレースホルダに置き換えたINSERT文をあらかじめ用意する
        // $sql = '
        //     INSERT INTO samurai (name, furigana, email, age, address)
        //     VALUES (:name, :furigana, :email, :age, :address)
        // ';
        $sql = '
             UPDATE samurai
             SET name = :name,
             furigana = :furigana,
             email = :email,
             age = :age,
             address = :address
             WHERE id = :id
         ';

        $stmt = $pdo->prepare($sql);

        // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
        $stmt->bindValue(':name', $_POST['samurai_name'], PDO::PARAM_STR);
        $stmt->bindValue(':furigana', $_POST['samurai_furigana'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $_POST['samurai_email'], PDO::PARAM_STR);
        $stmt->bindValue(':age', $_POST['samurai_age'], PDO::PARAM_INT);
        $stmt->bindValue(':address', $_POST['samurai_address'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
        // SQL文を実行する
        $stmt->execute();

        // header()関数を使ってselect.phpにリダイレクトさせる
        header('Location: select.php');
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
if (isset($_GET['id'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);

        $sql = 'SELECT * FROM samurai WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === FALSE) {
            exit('idパラメータの値が不正です。。。');
        }
        } catch (PDOException $e)  {
            exit($e->getMessage());
        }
    
    } else {
        // idパラメータの値が存在しない場合はエラーメッセージを表示して処理を停止する
        exit('idパラメータの値が存在しません。');
    }




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
    <p>編集したい情報を入力してください。更新するときは<span class="caution">UPDATEおす！</span></p>
   

    <form method="post" action="update.php?id=<?= $_GET['id'] ?>">
        <div>
            <label for="samurai_name">お名前<span>【必須】</span></label>
            <input type="text" id="samurai_name" name="samurai_name" value="<?= $user['name'] ?>" maxlength="60" required >

            <label for="samurai_furigana">ふりがな<span>【必須】</span></label>
            <input type="text" id="samurai_furigana" name="samurai_furigana" value="<?= $user['furigana'] ?>" maxlength="60" required >

            <label for="samurai_email">メールアドレス<span>【必須】</span></label>
            <input type="email" id="samurai_email" name="samurai_email" value="<?= $user['email'] ?>" maxlength="255" required >

            <label for="samurai_age">年齢</label>
            <input type="number" id="samurai_age" name="samurai_age" value="<?= $user['age'] ?>" min="13" max="130">

            <label for="samurai_address">住所</label>
            <input type="text" id="samurai_address" name="samurai_address" value="<?= $user['address'] ?>" maxlength="255">
        </div>

    <div class="button">
    <!-- <button type="submit" name="submit" value="insert">新規登録　INSERT</button> -->

    <button type="submit" name="submit" value="update">ユーザー情報更新　UPDATE</button>

    </div>
    
    
    </form>

    <button type="submit" name="submit" value="insert"><a href="http://localhost:8888/php_samurai/select.php">SELECT一覧へ</a></button>

</body>
</html>
