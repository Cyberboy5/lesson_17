<?php
namespace App\Helpers;


class View{

    public static function make($view,$title,$data = []){

        ob_start();
        include dirname(__DIR__) . "/Views/" . $view . ".php";
        $content = ob_get_clean();
        include dirname(__DIR__) . "/Views/main.php";
    }

    public static function make2($view,$title,$authors_genres = []){
        // ob_start();
        include dirname(__DIR__) . "/Views/" . $view . ".php";
        // $content = ob_get_clean();
        // include dirname(__DIR__) . "/Views/main.php";
    }
}



?>