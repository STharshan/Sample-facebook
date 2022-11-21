<?php

      $server = "localhost:3308";
      $user = "root";
      $dbpass = "";
      $db = "tharsan";
    
      try{
        $con = new PDO("mysql:host=$server;dbname=$db;charset=UTF8", "$user", "$dbpass");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }catch(PDOExcetion $e){
        die("Error in connection");
      }
?>