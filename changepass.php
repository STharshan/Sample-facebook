<?php

echo "<h1>Change Password</h1>";

/*

from this page user must be able to change their password 

$sql = "update user set pawword='md5($newpass)' where username='username'

*/

include "setting.php";

if(isset($_REQUEST["changepass"])){
    $name = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $newpass = $_REQUEST["npassword"];
    $password = md5($password);         //encrypting password with md5 encryption
    $newpass = md5($newpass);           //encrypting new password with md5 encryption


    $sql = "SELECT * from user WHERE username='".$name."'";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchall();
    

    //check whether username exists
    if(count($result)>0){

        $sql = "SELECT PASSWORD from user WHERE username='".$name."'";
        $stmt=$con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchcolumn();

        //check wheter password is correct
        if(strcmp($password,$result)==0){
            $sql = "UPDATE user SET password='".$newpass."' where username='".$name."'";
            $stmt=$con->prepare($sql);
            $stmt->execute();

            echo "Password updated successfully!....";
        }
        else {
            header("Location:index.php?er=4"); //diplay "incorrect password"
        }
        

    } else {

        header("Location:index.php?er=3"); //display "user not found"

    }
}


?>


<html>
    <table>
        <form action="changepass.php">
            <tr>
            <th><label for="user">Username:</label></th>
            <td><input type="text" name="username" id="username"><br><br></td>
            </tr>
            <tr>
            <th><label for="password">Password:</label></th>
            <td><input type="password" name="password" id="password"><br><br></td>
            </tr>
            <tr>
            <th><label for="npassword">New Password:</label></th>
            <td><input type="password" name="npassword" id="npassword"><br><br></td>
            </tr>
            <tr>
                <td><input type="submit" name="changepass" value="Change Password"></td>
            </tr>
        </form>
    </table>
    <a href="sign_in_page.php">Login Page</a>
</html>