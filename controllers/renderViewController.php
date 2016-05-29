<?php
class renderViewController{
    function processTemplate ($templatePath, $array) {
//        if (strcmp($templatePath, "views/logIn.php") != 0 ) {
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
/*        } else {
            $template = file_get_contents($templatePath);
            $template = str_replace("{title}", 
                                    $array[0], $template);

        }  */
        return $template;
    }

}
