<?php

namespace App\Controllers;

use App\Model\Model;
use App\Model\Task;
use App\Model\User;

class UserController{

    public function admin_page(){
        if(isset($_POST['more_info']) && !empty($_POST['status'])){
            $status = $_POST['status'];
            $tasks = Task::getTasks($status);
        }else{
            $tasks = Task::getTasks();
        }
        // dd($tasks);

        return view('adminPage/index','Admin Page',$tasks);
    }


    public function users_page(){
        $users = User::getAll();
        return view("users/users",'Users',$users);
    }

    public function activateUser(){
        
        if(isset($_POST['activate']) && !empty($_POST['id'])){
            if(User::changeStatus($_POST['id'])){
                header("Location:/users");
            }
        }
    }
    





}

?>