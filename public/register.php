<?php
    session_start();
    require_once '../classes/UserLogic.php';
    $err = [];

    //siginup_formから送信されたトークンがあっているか
    $token = filter_input(INPUT_POST, 'csrf_token');
    //トークンが一致しない、無い場合処理を中止
    if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        exit('不正なリクエストです');
    }
    unset($_SESSION['csrf_token']);

    if(!$username = filter_input(INPUT_POST, 'username')) {
        $err[] = 'ユーザー名を記入してください';
    }
    if(!$email = filter_input(INPUT_POST, 'email')) {
        $err[] = 'メールアドレスを入力してください';
    }
    $password = filter_input(INPUT_POST, 'password');
    if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
        $err[] = 'パスワードは英数字8文字以上100文字以下にしてください。';
    }
    $password_conf = filter_input(INPUT_POST, 'password_conf');
    if ($password !== $password_conf) {
        $err[] = '確認用パスワードと異なっています。';
    }
    if(count($err) === 0) {
        $hasCreated = UserLogic::createUser($_POST);
        if(!$hasCreated) {
            $err[] = '登録に失敗しました';
        }
    }
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
    <a href="./siginup_form.php">戻る</a>
</body>
</html>