<?php

namespace App\Model;

use App\Database\Database;
use PDO;
use PDOException;

class Model extends Database {

    public static function getAll() : array 
    {
        $con = self::connect(); 
        try {
            $query = "SELECT * FROM " . static::$table_name;

            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function delete($id){
        try{
            $query = "DELETE FROM " . static::$table_name . " WHERE id = :id"; 
            
            $stmt = self::connect()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
            
        }catch(PDOException $e){
            return false;
        } 
    }

    public static function edit($new_name,$id){
       
        try{    
            $query = "UPDATE " .  static::$table_name . " SET name = '{$new_name}' WHERE id = '{$id}'";
    
            $stmt = self::connect()->prepare($query);
            $stmt->execute();
            return true;
        
        }catch(PDOException $e){
            return false;

        }
    }

    public static function create($data) {
        // Create placeholders and column names from the array keys
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
    
        // Prepare the query
        $query = "INSERT INTO " . static::$table_name . " ($columns) VALUES ($placeholders)";
    
        try {
            // Connect to the database
            $conn = self::connect();
            $stmt = $conn->prepare($query);
    
            // Bind parameters dynamically
            foreach ($data as $key => $value) {
                // Check if the key is 'password' and hash it using md5
                if ($key == 'password') {
                    $value = md5($value);
                }
                $stmt->bindValue(":$key", $value);
            }
    
            // Execute the query
            $stmt->execute();
    
            // Return the ID of the inserted row
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            // Handle the error
            return false;
        }
    }
    

    public static function register($data)
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
            $values .= "'{$value}' ,";
        }
        // dd($values);

        $cleanString = rtrim($values, ", ");
        // dd($cleanString);
        $stmt = $conn->prepare("INSERT INTO " . Task::$table_name . " (title, description,user_id,image) VALUES (" . $cleanString . ")");
        return $stmt->execute();
    }

    public static function get_data($data){

        $values = '';   
        foreach($data as $key=>$value){
            if($key =='password'){
                $value = md5(($value));
            }
            $values .= "{$key} = '{$value}' AND ";
        }

        $cleanString = rtrim($values,"AND ");
        // dd($cleanString);
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE (" . $cleanString . ")");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public static function query($query){
        $conn = self::connect();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    
}
