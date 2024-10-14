<?php

namespace App\Controllers;

use App\Model\Model;
use App\Model\Task;
use App\Model\User;

class Controller{

    public function login_page(){
        return view2('auth/login','Login Page');
    }

    public function login(){
        // dd($_POST);

        if(isset($_POST['submit']) && !empty($_POST['email'] && !empty($_POST['password']))){

            $email = htmlspecialchars(strip_tags($_POST['email']));
            $password = htmlspecialchars(strip_tags($_POST['password']));
    
            $data  = [
                'email' => $email,
                'password' => $password
            ];
    
            if(User::get_user($data)){
                header("Location:/admin_page");
            }
        }
    }

    public function register_page(){
        return view2('auth/register','Register Page');
    }

    public function register(){
        
        if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){
            
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $password = htmlspecialchars(strip_tags($_POST['password']));
            $password_confirm = htmlspecialchars(strip_tags($_POST['password_confirm']));
    
            if($password = $password_confirm){
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ];
        
                if(User::register($data)){
                    header("Location:/");

                }else{
                    $_SESSION['registration_messeges'] = "Erro While Registering User with this data: " .$data;
                }
            }else{
                $_SESSION['registration_messeges'] = "Check you passowrd again,please";
            }
        }else{
            $_SESSION['registration_messeges'] = "Please fill every field";
        }
    }

}

?>