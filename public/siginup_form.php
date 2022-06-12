<?php
session_start();
require_once '../functions.php';
require_once '../classes/UserLogic.php';
$result = UserLogic::checkLogin();

if($result) {
    header('Location: mypage.php');
    return;
}
// 条件 ? trueの時 : falseの時
$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー登録画面</title>
</head>
<body>
    <h2>ユーザー登録フォーム</h2>
    <?php if(isset($login_err)): ?>
        <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <form action="/public/register.php" method="post">
        <p>
            <label for="username">ユーザー名</label>
            <input type="text" name="username" id="username">
        </p>
        <p>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email">
        </p>
        <p>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password">
        </p>
        <p>
            <label for="password_conf">パスワード確認</label>
            <input type="password" name="password_conf" id="password_conf">
        </p>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <input type="submit" value="新規登録">
    </form>
    <a href="login_form.php">ログインする</a>
</body>
</html>