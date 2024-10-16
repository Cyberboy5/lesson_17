<?php

namespace App\Controllers;

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
    
            if(User::get_data($data)){
                $_SESSION['user'] = User::get_data($data);
                if($_SESSION['user']['role'] == 'admin'){
                    header("Location:/admin_page");
                }else{
                    header("Location:/user_page");
                }
            }else{
                $_SESSION['login_messeges'] = "Erro While Logging in User";
                header("Location:/");
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
    
            // dd($password,$password_confirm);
            if($password == $password_confirm){
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ];
        
                if(User::create($data)){
                    $_SESSION['user'] = User::get_data($data);
                    header("Location:/");
                    return;
                }else{
                    $_SESSION['registration_messeges'] = "Erro While Registering User";

                }
            }else{
                $_SESSION['registration_messeges'] = "Check you passoword again,please";
            }
        }else{
            $_SESSION['registration_messeges'] = "Please fill every field";
            
        }
        header("Location:/register");

    }

    public function logout(){
        
        unset($_SESSION['user']);
        header("Location:/");
    }

}

?>