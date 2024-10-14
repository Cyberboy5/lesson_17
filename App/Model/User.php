<?php

namespace App\Model;

use App\Model\Model;
use PDO;

class User extends Model{
    public static $table_name = "users";

    public static function changeStatus($id){
        $conn = self::connect();
        $stmt = $conn->prepare("UPDATE users SET status = 1 WHERE id = '{$id}'");
        return $stmt->execute();
    }
}
?>