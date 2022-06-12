<?php
    session_start();
    require_once '../classes/UserLogic.php';
    $err = [];
    if(!$email = filter_input(INPUT_POST, 'email')) {
        $err['email'] = 'メールアドレスを入力してください';
    }
    if(!$password = filter_input(INPUT_POST, 'password')) {
        $err['password'] = 'パスワードを入力してください';
    }
    if(count($err) > 0) {
        $_SESSION = $err;
        header('Location: login_form.php');
        return;
    }
    // ログイン成功時の処理
    $result = UserLogic::login($email,$password);
    // ログイン失敗時の処理
    if(!$result) {
        header('Location: login_form.php');
        return;
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン完了</title>
</head>
<body>
<h2>ログイン完了</h2>
<p>ログインしました。</p>
<a href="./mypage.php">マイページへ</a>
</body>
</html>