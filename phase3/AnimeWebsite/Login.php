<?php
require 'Model/Credentials.php';
//connection to the database
$dbhandle = mysqli_connect($host, $user, $passwd,$database) 
  or die("Unable to connect to MySQL");

if(isset($_POST['password'])&&isset($_POST['email_login'])){
    $password =$_POST['password']; // This is the original password input from the user
    $email_login =$_POST['email_login'];
    if(empty($password)||empty($email_login)){
        echo 'please fill in both blanks';
    }else{
        $database_mem = $dbhandle ->query("SELECT * FROM Member where '$email_login' =Email")or die(mysqli_error('ayaya'));
        if(mysqli_num_rows($database_mem)==1){
            
            $row = mysqli_fetch_array($database_mem);
            
            if($email_login==$row[0]) { 
                echo 'ayaya finally';
                if(hash_equals($row[3],crypt($password,$row[4])) ){
                    session_start();
                    $_SESSION['username']=$row[2];
                    $_SESSION['useremail']=$email_login;
                    header('Location: member_acc.php');
                    echo 'congrats you got member password match';
                }else{
                    echo'incorrect member password, please try again';
                }
            }
        }else{
            $database_admin = $dbhandle ->query("SELECT * FROM Admin where '$email_login'=Email");
            if(mysqli_num_rows($database_admin)==1){
                $row = mysqli_fetch_array($database_admin);
                if($row[3] == $password){
                    session_start();
                    $_SESSION['username']=$row[2];
                    $_SESSION['useremail']=$email_login;
                    header('Location: admin_acc.php');
                    echo 'congrats you got admin password match';
                }else{
                    echo 'wrong admin password, please try again.';
                }
            }else{
                echo'username does not exist, please try again.';
            }
        }

    }
    
}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">   
                
                <a style="color:black; font-size:25px" href="Login.php">Login</a>
                <a style="color:lightblue; font-size:25px" href="Register.php">Register</a>
            </div>
 
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Anime.php">Anime</a></li>
                    <li><a href="Manga.php">Manga</a></li>
                    <li><a href="VoiceActor.php">VoiceActor</a></li>
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="Forum.php">Forum</a></li>
                </ul>
            </nav>
        </div>  
        
        <br><br><br><br>
        <form action = "Login.php" method = "POST" align="center">
            <a style="color:lightgoldenrodyellow; font-size:18px">email:</a><br>  
            <input type ="text" name ="email_login"><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">password:</a><br>
            <input type ="password" name ="password"><br><br>
            <input type = "submit" value ="Login">
            </form>
        
        
        <br><br><br><br>

        
        
    </body>

</html>

