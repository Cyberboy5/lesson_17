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
        
        // Always include ORDER BY in the query
        $query .= " ORDER BY tasks.id DESC";
    
        // Query to count each status separately
        $countQuery = "SELECT 
                        SUM(CASE WHEN tasks.status = 'todo' THEN 1 ELSE 0 END) as todo_count,
                        SUM(CASE WHEN tasks.status = 'in progress' THEN 1 ELSE 0 END) as in_progress_count,
                        SUM(CASE WHEN tasks.status = 'done' THEN 1 ELSE 0 END) as done_count,
                        SUM(CASE WHEN tasks.status = 'rejected' THEN 1 ELSE 0 END) as rejected_count,
                        SUM(CASE WHEN tasks.status = 'completed' THEN 1 ELSE 0 END) as completed_count
                       FROM tasks";
        
        $conn = self::connect();
    
        // Prepare and execute task query
        if ($status) {
            $query .= " WHERE tasks.status = :status";  // Add WHERE clause before ORDER BY
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        } else {
            $stmt = $conn->prepare($query);
        }
        
        // Execute the query to get tasks
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Prepare and execute the count query for all statuses
        $countStmt = $conn->prepare($countQuery);
        $countStmt->execute();
        $statusCounts = $countStmt->fetch(PDO::FETCH_ASSOC);
    
        return [
            'tasks' => $tasks,
            'status_counts' => $statusCounts
        ];
    }
    
    
        
    public static function update($id, $data)
    {
        $conn = self::connect();
        $query = "UPDATE tasks SET title = :title, description = :description, user_id = :user_id, comment = :comment";

        if (isset($data['image'])) {
            $query .= ", image = :image";
        }

        $query .= " WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':comment', $data['comment']);

        if (isset($data['image'])) {
            $stmt->bindParam(':image', $data['image']);
        }
        return $stmt->execute();
    }
    public static function getTasksByStatus() {
        $userId = $_SESSION['user']['id'];
        $isNonAdmin = $_SESSION['user']['role'] != 'admin';
        
        $query = "SELECT tasks.id,
                        tasks.title,
                        tasks.description,
                        tasks.status,
                        users.name,
                        tasks.comment  
                FROM tasks
                LEFT JOIN users ON tasks.user_id = users.id";

    
        if ($isNonAdmin) {
            $query .= " WHERE tasks.user_id = :user_id";
        }
    
        $conn = self::connect();
        $stmt = $conn->prepare($query);
    
        if ($isNonAdmin) {
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $data = [
            'todo' => [],
            'in_progress' => [],
            'done' => [],
            'rejected' => [],
            'completed' => []
        ];
    
        foreach ($tasks as $task) {
            switch ($task['status']) {
                case 'todo':
                    $data['todo'][] = $task;
                    break;
                case 'in progress':
                    $data['in_progress'][] = $task;
                    break;
                case 'done':
                    $data['done'][] = $task;
                    break;
                case 'rejected':
                    $data['rejected'][] = $task;
                    break;
                case 'completed':
                    $data['completed'][] = $task;
                    break;
            }
        }
    
        return $data;
    }
    
    public static function updateTaskStatus($taskId, $newStatus) {
        $conn = self::connect();
        $query = "UPDATE tasks SET status = :newStatus WHERE id = :taskId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
        $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public static function rejectTaskComment($taskId,$comment) {
        $query = "UPDATE tasks 
                  SET status = 'rejected', comment = :comment 
                  WHERE id = :task_id";
                      
        $conn = self::connect();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
        return $stmt->execute();
    
    }
    
    }

?>