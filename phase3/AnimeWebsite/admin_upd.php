<?php
require 'Model/Credentials.php';
require ("Entities/AnimeEntity.php");
$output = '';
//connection to the database
$dbhandle = mysqli_connect($host, $user, $passwd,$database) 
  or die("Unable to connect to MySQL");

session_start();
$uEmail= $_SESSION['useremail'];


$result = $dbhandle->query("SELECT * FROM Anime") or die($dbhandle->error);
$count = $dbhandle->query("SELECT count(*) from Anime") or die($dbhandle->error);
$newrow = mysqli_fetch_array($count);

//update anime status
if(isset($_POST['upd_status_title']) && isset($_POST['upd_status_season'])&& isset($_POST['upd_status'])){
    $upd_status_title = $_POST['upd_status_title'];
    $upd_status_season = $_POST['upd_status_season'];
    $upd_status = $_POST['upd_status'];
                
    if(!empty($upd_status_title)&& !empty($upd_status_season)&& !empty($upd_status)){
        $database_aniupd = $dbhandle ->query("SELECT * FROM Anime where '$upd_status_title' =Title and '$upd_status_season'= Season")or die($dbhandle->connect_error);
        if(mysqli_num_rows($database_aniupd)==1){
            if(!is_numeric($upd_status)){
                $database_aniupd = $dbhandle ->query("UPDATE Anime set a_Status='$upd_status' where ('$upd_status_title' =Title and '$upd_status_season'= Season)")or die($dbhandle->connect_error);
                header('Location: admin_acc.php');
            }else{
                $output .= "updated status must be string, $upd_status is not a string";
            }
            
        }else{
            $output.= "$upd_status_title $upd_status_season is not in Team PikaPika anime database yo!";
        }
    }else{
        $output .= "please fill in all blanks";
    }
}


//update anime episodes
if(isset($_POST['upd_epi_title']) && isset($_POST['upd_epi_season'])&& isset($_POST['upd_epi'])){
    $upd_epi_title = $_POST['upd_epi_title'];
    $upd_epi_season = $_POST['upd_epi_season'];
    $upd_epi = $_POST['upd_epi'];
                
    if(!empty($upd_epi_title)&& !empty($upd_epi_season)&& !empty($upd_epi)){
        $database_aniupd = $dbhandle ->query("SELECT * FROM Anime where '$upd_epi_title' =Title and '$upd_epi_season'= Season")or die($dbhandle->connect_error);
        if(mysqli_num_rows($database_aniupd)==1){
            if(is_numeric($upd_epi)){
                $database_aniupd = $dbhandle ->query("UPDATE Anime set num_of_episodes='$upd_epi' where ('$upd_epi_title' =Title and '$upd_epi_season'= Season)")or die($dbhandle->connect_error);
                header('Location: admin_acc.php');
            }else{
                $output.="updated episode number must be an integer";
            }
            
        }else{
            $output.= "$upd_epi_title $upd_epi_season is not in Team PikaPika anime database yo!";
        }
    }else{
        $output .= "please fill in all blanks";
    }
}


if ($result->num_rows){

    while($row = mysqli_fetch_array($result)){
        $title = $row[0];
        $genre = $row[1];
        $rating = $row[2];
        $description = $row[3];
        $season= $row[4];
        $a_status = $row[5];
        $start_date = $row[6];
        $studio = $row[7];
        $num_of_episode = $row[8];
        
        $anime = new AnimeEntity($title, $genre, $rating, $description, $season, $a_status, $start_date,$studio,$num_of_episode);

        $output .= 
                "<table class = 'animeTable'>
                <tr>
                    <th width = '75px' >Title: </th>
                    <td> $anime->title</td>
                </tr><br>


                <tr>
                    <th>Genre: </th>
                    <td>$anime->genre</td>
                </tr><br>


                <tr>
                    <th>Rating: </th>
                    <td>$anime->rating</td>
                </tr><br>

                <tr>
                    <th>Description: </th>
                    <td>$anime->description</td>
                </tr><br>
                
                <tr>
                    <th>Season: </th>
                    <td>$anime->season</td>
                </tr><br>
                
                <tr>
                    <th>Status: </th>
                    <td>$anime->a_status</td>
                </tr><br>
                
                <tr>
                    <th>Air: </th>
                    <td>$anime->start_date</td>
                </tr><br>
                
                <tr>
                    <th>Studio: </th>
                    <td>$anime->studio</td>
                </tr><br>
                
                <tr>
                    <th>Number of Episodes: </th>
                    <td>$anime->num_of_episode</td>
                </tr>
                
                <br>
                
             </table>";

    }
}else{
    echo 'There are currently '.$newrow[0].' anime in our team PikaPika database';
    $output .= "There is currently no anime in our database";
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
                
                <a style="color:whitesmoke; font-size:25px" href="logout.php">Logout</a><br>
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
        
        <br><br>
        
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_acc.php">Admin Main</a><br><br>
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_del.php">Delete Anime</a><br><br>
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_add.php">Add Anime</a><br><br>
        <a align="center" style="color:lightcyan; font-size:24px" >Update Anime</a><br><br>
        
        
        
        <form action = "admin_upd.php" method = "POST" align="center">
            <a style="color:lightgoldenrodyellow; font-size:23px" >Update anime status</a><br><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">title:</a><br>  
            <input type ="text" name ="upd_status_title"><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">season number:</a><br>
            <input type ="text" name ="upd_status_season"><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">updated anime status:</a><br>
            <input type ="text" name ="upd_status"><br><br>
            <input type = "submit" value ="update">
            </form>
        
        <br><br><br><hr><br><br>
        
        <form action = "admin_upd.php" method = "POST" align="center">
            <a style="color:lightgoldenrodyellow; font-size:23px" >Update anime status</a><br><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">title:</a><br>  
            <input type ="text" name ="upd_epi_title"><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">season number:</a><br>
            <input type ="text" name ="upd_epi_season"><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">updated number of episodes:</a><br>
            <input type ="text" name ="upd_epi"><br><br>
            <input type = "submit" value ="update">
            </form>
        
        <br><br><br>
        
           <?php
            print("$output");
            ?>  
        
        
    </body>

</html>