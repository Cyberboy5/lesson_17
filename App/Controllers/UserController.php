<?php

namespace App\Controllers;

use App\Model\Task;
use App\Model\User;

class UserController{

    public function admin_page(){
        if(isset($_POST['more_info']) && !empty($_POST['status'])){
            $status = $_POST['status'];
            $tasks = Task::getTasks($status);
            // dd($tasks);
        }else{
            $tasks = Task::getTasks();
        }
        if($_SESSION['user']['role'] == 'admin'){
            return view('adminPage/index','Admin Page',$tasks);
        }else{
            return view2('auth/login','Login Page');
        }
        // dd($tasks);
    }

    public function users_page(){
        $users = User::getAll();
        return view("users/users",'Users',$users);
    }

    public function activateUser(){
        
        if(isset($_POST['activate']) && !empty($_POST['id'])){
            if(User::changeStatus($_POST['id'],1)){
                header("Location:/users");
            }
        }elseif(isset($_POST['deactivate']) && !empty($_POST['id'])){
            if(User::changeStatus($_POST['id'],0)){
                header("Location:/users");
            }
        }
    }
    
    public function user_page(){
        if($_SESSION['user']['status'] == 0){
            return view('userPage/error','User Not Allowed');
        }else{
            $data = Task::getTasksByStatus();
            return view('userPage/index','User Page',$data);
        }
        // dd($data);
    }
}

?>