<?php

namespace App\Model;

use App\Model\Model;
use PDO;

class User extends Model{
    public static $table_name = "users";

    public static function changeStatus($id,$activ){
        $conn = self::connect();
        $stmt = $conn->prepare("UPDATE users SET status = '{$activ}' WHERE id = '{$id}'");
        return $stmt->execute();
    }

    public static function register_user($data)
    {
        // dd($data);
        
        $conn = self::connect();

        if(isset($_POST['email'])){
            $email = $data['email'];
            $query = "SELECT COUNT(*) AS 'total' FROM " . static::$table_name . " WHERE email = '{$email}'";
            
            if(self::query($query)[0]['total'] > 0){
                $_SESSION['login_messeges'] = "Email already registered!";
                return false;
            }
        }

        $values = '';
        foreach ($data as $key => $value) {
            if ($key == 'password') {
                $value = md5($value);
            }
            $values .= "'{$value}' , ";
        }
        // dd($values);

        $cleanString = rtrim($values, ", ");
        // dd($cleanString);
        $stmt = $conn->prepare("INSERT INTO " . User::$table_name . " (name,email,password) VALUES (" . $cleanString . ")");
        return $stmt->execute();
    }

}
?>