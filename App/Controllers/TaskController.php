<?php

namespace App\Controllers;

use App\Model\Task;
use App\Model\User;

class TaskController{

    public function createTask_page(){
        $users = User::getAll();
        return view('adminPage/createTask','Task-Creation',$users);
    }

    public function createTask(){
        
        $title = htmlspecialchars(strip_tags($_POST['title']));
        $description = htmlspecialchars(strip_tags($_POST['description']));
        $user_id = (int) $_POST['user_id'];  // Casting user_id to integer
        $status = htmlspecialchars(strip_tags($_POST['status']));
        
        $image = $_FILES['image'];
        $image_name = htmlspecialchars(strip_tags($image['name']));
        $image_tmp_name = $image['tmp_name'];
        $image_size = $image['size'];
        $image_error = $image['error'];
        
        $upload_dir = 'uploads/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        if ($image_error === 0 && $image_size > 0) {
            $image_path = $upload_dir . basename($image_name);
        
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'user_id' => $user_id,
                    'status' => $status,
                    'image_path' => $image_path,
                ];

                // dd($data);
        
                if (Task::register($data)) {
                    header("Location:/admin_page");
                } else {
                    echo 'Something went wrong';
                }
            } else {
                echo 'Error uploading image.';
            }
        } else {
            echo 'Invalid file upload.';
        }
        
    }

    
    public function editTask_page(){
        // dd($_POST);  
        $users = User::getAll();    
        return view('adminPage/editTask','Edit-Task',$users);
    }



    public function editTask()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // dd($_POST);
            $id = (int) htmlspecialchars(strip_tags($_POST['id']));
            $title = htmlspecialchars(strip_tags($_POST['title']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $user_id = (int) htmlspecialchars(strip_tags($_POST['user_id']));
            $status = htmlspecialchars(strip_tags($_POST['status']));
            $comment = htmlspecialchars(strip_tags($_POST['comment']));
    
            $image_path = null;
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = 'uploads/';
    
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
    
                $image_name = htmlspecialchars(strip_tags($_FILES['image']['name']));
                $image_tmp_name = $_FILES['image']['tmp_name'];

                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $new_image_name = uniqid('task_image_', true) . '.' . $image_extension;
                $image_path = $upload_dir . $new_image_name;
    
                if (move_uploaded_file($image_tmp_name, $image_path)) {
                } else {
                    echo "Error uploading image.";
                    return;
                }
            }
    
            $data = [
                'title' => $title,
                'description' => $description,
                'user_id' => $user_id,
                'status' => $status,
                'comment' => $comment,
            ];
    
            if ($image_path) {
                $data['image'] = $image_path;
            }
    
            if (Task::update($id, $data)) {
                header("Location:/admin_page");
            } else {
                echo 'Failed to update task.';
            }
        }
    }

    public function deleteTask() {
        $id = $_POST['id'];
        // Execute the query
        if (Task::delete($id)){
           header("Location:/admin_page");
        } else {
            echo "Erro while Deleteing Task"; 
        }
    }
}

?>