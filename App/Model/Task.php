<?php

namespace App\Model;

use App\Model\Model;
use PDO;

class Task extends Model{
    public static $table_name = "tasks";

    public static function getTasks($status = '') {
        $query = "SELECT 
                    tasks.id, 
                    tasks.title,
                    tasks.description,
                    users.name,
                    tasks.status,
                    tasks.comment,
                    tasks.image 
                  FROM tasks
                  LEFT JOIN users ON tasks.user_id = users.id";
        
        $conn = self::connect();
        // dd($status);
        if ($status) {
            $query .= " WHERE tasks.status = :status";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR); 
        } else {
            $stmt = $conn->prepare($query);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function update($id, $data)
    {
        $conn = self::connect();
        $query = "UPDATE tasks SET title = :title, description = :description, user_id = :user_id, status = :status, comment = :comment";

        if (isset($data['image'])) {
            $query .= ", image = :image";
        }

        $query .= " WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':comment', $data['comment']);

        if (isset($data['image'])) {
            $stmt->bindParam(':image', $data['image']);
        }
        return $stmt->execute();
    }
}

?>