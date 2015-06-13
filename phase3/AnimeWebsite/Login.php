<?php
require 'Model/Credentials.php';
//connection to the database
$dbhandle = mysqli_connect($host, $user, $passwd,$database) 
  or die("Unable to connect to MySQL");

if(isset($_POST['password'])&&isset($_POST['email_login'])){
    $password =$_POST['password'];
    $email_login =$_POST['email_login'];
    if(empty($password)||empty($email_login)){
        echo 'please fill in both blanks';
    }else{
        $database_mem = $dbhandle ->query("SELECT * FROM Member where '$email_login' =Email")or die(mysqli_error('ayaya'));
        if(mysqli_num_rows($database_mem)==1){
            $row = mysqli_fetch_array($database_mem);
            if($email_login==$row[0]) {            
                if($row[3] == $password){
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
                
                <a style="color:whitesmoke; font-size:25px" href="Login.php">Login</a>
                    <a style="color:whitesmoke; font-size:25px" href="#">Register</a>
            </div>
 
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Anime.php">Anime</a></li>
                    <li><a href="Manga.php"><strong>Manga</strong></a></li>
                    <li><a href="VoiceActor.php">VoiceActor</a></li>
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="Forum.php">Forum</a></li>
                </ul>
            </nav>
        </div>  
        
        
        <form action = "Login.php" method = "POST">
            email:<br>  
            <input type ="text" name ="email_login"><br>
            password:<br>
            <input type ="password" name ="password"><br><br>
            <input type = "submit" value ="Login">
            </form>
        
        
        

        
        
    </body>

</html>

