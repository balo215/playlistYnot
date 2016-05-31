<?php
class renderViewController{
    function processTemplate ($templatePath, $array) {
            $template = file_get_contents($templatePath);
            if(isset($_SESSION) && $_SESSION != NULL){
                $header = file_get_contents("views/headerL.html");
                $header = str_replace("{USER}", 
                                    $_SESSION['email'], $header);
            }else{
                $header = file_get_contents("views/header.html");
            }
            $footer = file_get_contents("views/footer.html");
            $template = $header.$template.$footer;
        return $template;
    }

    function processMainTemplate($templatePath, $array){
        $template = file_get_contents($templatePath);
        $template = str_replace('{LIST}', array_keys($array), $template);
        if(isset($_SESSION) && $_SESSION != NULL){
            $header = file_get_contents("views/headerL.html");
            $header = str_replace("{USER}", 
            $_SESSION['email'], $header);
        }else{                  
            $header = file_get_contents("views/header.html");
        }   
        $footer = file_get_contents("views/footer.html");
        $template = $header.$template.$footer;
        return $template;

    }

    function processView($view){
        $view = str_replace("{USER}", $_SESSION['email'], $view);
        $header = file_get_contents("views/headerT.html");
        $footer = file_get_contents("views/footer.html");
        $view = $header.$view.$footer;
        return $view;
    }
    function processMainView($view, $top3){
        $view = str_replace("{LIST}", $top3, $view);
        $header = file_get_contents("views/headerT.html");
        $footer = file_get_contents("views/footer.html");
        $view = $header.$view.$footer;
        return $view;

    }

}
