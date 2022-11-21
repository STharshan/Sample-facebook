<?php
    include "setting.php";
    echo"<h1>Sign In</h1>";

    if(isset($_REQUEST["signin"])){
        $name = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $password = md5($password);
    

        $sql = "SELECT * from user WHERE username='".$name."'";
        $stmt=$con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchall();
        
        //check whether username exists
        if(count($result)>0){

            $sql = "SELECT PASSWORD from user WHERE username='".$name."'";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            //$result=$stmt->fetch(PDO::FETCH_ASSOC);
            $result = $stmt->fetchcolumn();

            //checks whether password is correct
            if(strcmp($password,$result)==0){
                header("Location:index.php?er=6"); //directs to user account
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
    <head>
    </head>
    <table>
    <form action="sign_in_page.php">
        <tr>
        <th><label for="user">Username</label></th>
        <td><input type="text" name="username" id="username"><br><br></td>
        </tr>
        <tr>
        <th><label for="password">Password</label></th>
        <td><input type="password" name="password" id="password"><br><br></td>
        </tr>
        <tr><td><input type="submit" name="signin" value="Sign In"></td></tr>
    </form>
</table>
<a href="removeuser.php">Forgot Password</a>
</html>