<?php
    echo"<h1>Sign Up</h1>";

    include "setting.php";
    include "index.php";


    /*
    1. connection to the db
    */
        $query="SELECT * from user";
        $stmt=$con->prepare($query);
        $stmt->execute();
        $list=$stmt->fetchall();
    

    /*
    2. check the username is exists or not
        a. Exists-return to the main page and diplay error
        b. Not-Insert query
    */

    if(isset($_REQUEST["signup"])){
        $email = $_REQUEST["email"];
        $name = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $cpassword = $_REQUEST["cpassword"];
        
        //checks whether all detaila are provided
        if(!empty($email) && !empty($name) && !empty($password) && !empty($cpassword)){

            //checks whether password and confirmed password are same
            if(strcmp($password,$cpassword)==0){

                $password = md5($password);   //encrypting password using md5 algorithm
    

                $sql = "SELECT * from user WHERE username='".$name."'";
                $stmt=$con->prepare($sql);
                $stmt->execute();
                $result=$stmt->fetchall();
        
                //Checks for existense of the username
                if(count($result)>0){

                    header("Location:index.php?er=1"); //display "username already exists."
            

                } else {

                    $sql = "INSERT into user set username='".$name."', password='".$password."', email='".$email."'";
                    //$sql = "INSERT into user set username='".$name."', password='".$password."', email='".$email."'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    header("Location:index.php?er=9"); 

                }
            } 
            else {
                echo "Wrong Password confirmation";
            }

        } 
        else {
            echo "Please provide all the details!";
        }
    }

    /*
    3. Return to the login.php file
    */
    
?>

<html>
    <table>
        <form action="sign_up_form.php">
            <tr>
            <th><label for="email">Email:</label></th>
            <td><input type="text" name="email" id="email"><br><br></td>
            </tr>
            <tr>
            <th><label for="user">Username:</label></th>
            <td><input type="text" name="username" id="username"><br><br></td>
            </tr>
            <tr>
            <th><label for="password">Password:</label></th>
            <td><input type="password" name="password" id="password"><br><br></td>
            </tr>
            <tr>
            <th><label for="cpassword">Confirm Password:</label></th>
            <td><input type="password" name="cpassword" id="cpassword"><br><br></td>
            </tr>
            <tr>
                <td><a href="sign_in_page.php"><b>Sign In</b></a></td>
                <td><input type="submit" name="signup" value="Sign Up"></td>
            </tr>
        </form>
    </table>
</html>