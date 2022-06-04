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
}