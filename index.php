<?php

    if(isset($_REQUEST["er"])){
        $error = $_REQUEST["er"];

        if($error==1)
            echo "Username already exists.....";
        if($error==2)
            echo "Username does not exists.....";
        if($error==3)
            echo "User not found!...";
        if($error==4)
            echo "Incorrect Password...";
        if($error==6)
            echo"Welcome to your account!...";
        if($error==9){
            //echo "Registration successful... Now you can login to the system";
            header("Location:sign_in_page.php");
        }
        
            
            
    }
?>