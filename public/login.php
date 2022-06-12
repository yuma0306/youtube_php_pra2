<?php
    session_start();
    $err = $_SESSION;
    $_SESSION = [];
    session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン画面</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <?php if(isset($err['msg'])): ?>
        <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>
    <form action="top.php" method="post">
        <p>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email">
            <?php if(isset($err['email'])): ?>
                <p><?php echo $err['email']; ?></p>
            <?php endif; ?>
        </p>
        <p>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password">
            <?php if(isset($err['password'])): ?>
                <p><?php echo $err['password']; ?></p>
            <?php endif; ?>
        </p>
        <input type="submit" value="ログイン">
    </form>
    <a href="./siginup_form.php">新規登録はこちら</a>
</body>
</html>