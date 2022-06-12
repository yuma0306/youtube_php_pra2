<?php
    
    require_once '../classes/UserLogic.php';
    session_start();
    $err = [];
    if(!$email = filter_input(INPUT_POST, 'email')) {
        $err['email'] = 'メールアドレスを入力してください';
    }
    if(!$password = filter_input(INPUT_POST, 'password')) {
        $err['password'] = 'パスワードを入力してください';
    }
    if(count($err) > 0) {
        $_SESSION = $err;
        header('Location: login.php');
        return;
    }
    // ログイン成功時の処理
    $result = UserLogic::login($email,$password);
    if(!$result) {
        header('Location: login.php');
    }
    echo 'ログイン成功です';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー登録完了画面</title>
</head>
<body>
    <?php if (count($err) > 0): ?>
    <?php foreach($err as $e): ?>
    <p><?php echo $e; ?></p>
    <?php endforeach; ?>
    <?php else: ?>
    <p>ユーザー登録が完了しました。</p>
    <?php endif; ?>
    <a href="./login.php">戻る</a>
</body>
</html>