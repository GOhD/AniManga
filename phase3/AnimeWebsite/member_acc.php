<?php
require 'Model/Credentials.php';
//connection to the database
$dbhandle = mysqli_connect($host, $user, $passwd,$database) 
  or die("Unable to connect to MySQL");

session_start();
$uEmail= $_SESSION['useremail'];

$fav = $dbhandle ->query("SELECT Title FROM Favored where '$uEmail' =Email")or die(mysqli_error('ayaya'));
$output='';
            if(isset($_POST['del_fav'])){
                    $del_fav = $_POST['del_fav'];
                
                if(!empty($del_fav)){
                    $database_fav = $dbhandle ->query("SELECT * FROM Favored where '$del_fav' =Title")or die(mysqli_error('ayaya'));
                    if(mysqli_num_rows($database_fav)==1){
                        $database_fav = $dbhandle ->query("Delete FROM Favored where '$del_fav' =Title")or die(mysqli_error('ayaya'));
                        $output.= "$del_fav has been deleted from your favourited list yo!<br> Refresh to see your new list~";
                    }else{
                        $output.= "$del_fav is not in your favourited list yo!";
                    }
                }else{
                    $output .= "please fill in blank";
                }
            }

            if(isset($_POST['add_fav'])){
                    $add_fav = $_POST['add_fav'];
                
                if(!empty($add_fav)){
                    $anibase_fav = $dbhandle ->query("SELECT * FROM Anime where '$add_fav' =Title")or die(mysqli_error('ayaya'));
                    if(mysqli_num_rows($anibase_fav)==1){
                        $row = mysqli_fetch_array($anibase_fav);

                        mysqli_query($dbhandle,"INSERT INTO Favored (Title,Email) 
                        VALUES ('$row[0]','$uEmail')");

                        $output.= "$add_fav has been added to your favourited list yo!<br> Refresh to see your new list~";
                    }else{
                        $output.= "$add_fav is not in our anime database yo!";
                    }
                }else{
                    $output .= "please fill in blank";
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
                
                <a style="color:whitesmoke; font-size:25px" href="Logout.php">Logout</a><br>
                    <a style="color:greenyellow; font-size:20px" ><?php echo'welcome, '.$_SESSION['username'];?></a>
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
        
        <br><br><br>
        <a style="color:lightcoral; font-size:18px">
            <?php echo $_SESSION['username'];?>'s favourited animated list:</a><br>
        <br>
        <?php
        while($r = mysqli_fetch_array($fav)){
    
            echo "$r[0]<br><br>";
            
        }
        ?>
        
        <form action = "member_acc.php" method = "POST" align="center">
            <a style="color:lightgoldenrodyellow; font-size:18px">delete from my favourited list:</a><br>  
            <input type ="text" name ="del_fav"><br><br>
            <input type = "submit" value ="delete">
            </form>
        
        <br><br>
        <form action = "member_acc.php" method = "POST" align="center">
            <a style="color:lightgoldenrodyellow; font-size:18px">Add anime to my favourited list:</a><br>  
            <input type ="text" name ="add_fav"><br><br>
            <input type = "submit" value ="add">
            </form>
        
        
        <?php print("$output");?>
        
        

        
        
    </body>

</html>