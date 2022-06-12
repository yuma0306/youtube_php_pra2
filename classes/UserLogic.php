<?php
require_once '../dbconnect.php';

class UserLogic
{
    /**
     * ユーザーを登録
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData) {
        $result = false;
        $sql = 'INSERT INTO users(name, email, password) VALUE(?, ?, ?)';
        $arr = [];
        $arr[] = $userData['username'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);
        try {
            $stmt =connect()->prepare($sql);
            //成功したらtrueを返す
            $result = $stmt->execute($arr);
            return $result;
        } catch(\Exception $e) {
            return $result;
        }
    }

    /**
     * ログイン処理
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email, $password) {
        $result = false;
        //ユーザーをemailから検索
        $user = self::getUserByEmail($email);
        if(!$user) {
            $_SESSION['msg'] = 'emailが一致しません';
            return $result;
        }
        //パスワードの照会
        if(password_verify($password, $user['password'])) {
            //古いセッションを破棄して新しいセッションを作成する（セッションハイジャック対策）
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }
        $_SESSION['msg'] = 'パスワードが一致しません';
        return $result;
    }

    /**
     * emailからユーザーを取得
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email) {
        //SQLの準備
        $sql = 'SELECT * FROM users WHERE email = ?';

        //emailを配列に入れる
        $arr = [];
        $arr[] = $email;

        //SQLの実行
        //SQLの結果を返す
        try {
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            $user = $stmt->fetch();
            return $user;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * ログインチェック
     * @param void
     * @return bool $result
     */
    public static function checkLogin() {
        $result = false;
        //セッションにログインユーザーが入ってなかったらfalse
        if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
            return $result = true;
        }
        return $result;
    }
}