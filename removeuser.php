<?php
echo "<h1>Remove User</h1>";
include "setting.php";

/*
$sql = "delete form user where username=$username";
*/

if(isset($_REQUEST["removeuser"])){
    $name = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql = "SELECT * from user WHERE username='".$name."'";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchall();
        
    //checks whether username exists
    if(count($result)>0){

        $password = md5($password);           //encrypting password using md5 algorithm
        
        $sql = "SELECT PASSWORD from user WHERE username='".$name."'";
        $stmt=$con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchcolumn();

        //checks whether password is correct
        if(strcmp($password,$result)==0){
            $sql = "DELETE FROM user WHERE username='".$name."'";
            $stmt=$con->prepare($sql);
            $stmt->execute();
    
            echo "User removed successfully";
        }
        else {
            header("Location:index.php?er=4"); //diplay "incorrect password"
        }
        
            
    }
    else{
        header("Location:index.php?er=2"); //display "username does not exists."
    
    }

}
?>

<html>
    <table>
        <form action="removeuser.php">
            <tr>
                <th><label for="user">Username:</label></th>
                <td><input type="text" name="username" id="username"><br><br></td>
            </tr>
            <tr>
                <th><label for="password">Password:</label></th>
                <td><input type="password" name="password" id="password"><br><br></td>
            </tr>
            <tr>
            <td><input type="submit" name="removeuser" value="Remove User"></td>
            </tr>
        </form>
    </table>
</html>