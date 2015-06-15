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

if(isset($_POST['add_title']) && isset($_POST['add_season'])){
    $add_title = $_POST['add_title'];
    $add_season = $_POST['add_season'];
    $add_genre = $_POST['add_genre'];
    $add_rating =$_POST['add_rating'];
    $add_a_status =$_POST['add_a_status'];
    $add_start_date =$_POST['add_start_date'];
    $add_studio =$_POST['add_studio'];
    $add_num_of_episodes =$_POST['add_num_of_episodes'];
    $add_description =$_POST['add_description'];
    $add_link = $_POST['add_link'];
    
    if(!empty($add_title)&& !empty($add_season)){
        if(is_numeric($add_season)&&  is_string($add_title)){
            $ala = $dbhandle ->query("select * from Animated_Series where '$add_title'=Title")or die($dbhandle->error);
            if(mysqli_num_rows($ala)==0)
                mysqli_query($dbhandle,"INSERT INTO Animated_Series (Title) VALUES ('$add_title')") or die($dbhandle->error);
            if(!$add_start_date){
                $k = $dbhandle ->query("select * from Anime where '$add_title'=Title and '$add_season'=Season")or die($dbhandle->error);
                if(mysqli_num_rows($k)==0){
                    $sql="INSERT INTO Anime (Title,Genre, Rating, Description, Season, a_Status, Start_date, Studio, num_of_episodes,link) 
                        VALUES ('$add_title','$add_genre','$add_rating','$add_description', '$add_season', '$add_a_status', null, '$add_studio', '$add_num_of_episodes','$add_link')";
                    mysqli_query($dbhandle,$sql)or die($dbhandle->error);
                    header('Location: admin_acc.php'); 
                }else{
                    $output .= "duplicate anime title and season number";
                }
                
             
                
            }else{
                $k = $dbhandle ->query("select * from Anime where '$add_title'=Title and '$add_season'=Season")or die($dbhandle->error);
                if(mysqli_num_rows($k)==0){
                    $sql="INSERT INTO Anime (Title,Genre, Rating, Description, Season, a_Status, Start_date, Studio, num_of_episodes,link) 
                        VALUES ('$add_title','$add_genre','$add_rating','$add_description', '$add_season', '$add_a_status', '$add_start_date', '$add_studio', '$add_num_of_episodes','$add_link')";
                    mysqli_query($dbhandle,$sql)or die($dbhandle->error);
                    header('Location: admin_acc.php'); 
                }else{
                    $output .= "duplicate anime title and season number";
                }
            }
           
        }else{
            $output .= "title must be string and season must be an integer value";
        }
        
    }else{
        $output .= "title or season cannot be blank";
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
        $link=$row[9];
        
        $anime = new AnimeEntity($title, $genre, $rating, $description, $season, $a_status, $start_date,$studio,$num_of_episode,$link);

        $output .= 
                "<table class = 'animeTable'>

                <tr>
                    <th rowspan='10' width = '150px' ><img  src ='$anime->link' /></th>
                    
                </tr><br>

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
                </tr><br>
                
                
                
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
                    <li><a href="Manga.php">Manga</a></li>
                    <li><a href="VoiceActor.php">VoiceActor</a></li>
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="Forum.php">Forum</a></li>
                </ul>
            </nav>
        </div>  
        
        <br><br>
        
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_acc.php">Admin Main</a><br><br>
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_del.php">Delete Anime</a><br><br>
        <a align="center" style="color:lightcyan; font-size:24px" ><strong>Add Anime</strong></a><br><br>
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_upd.php">Update Anime</a><br><br>
        
        
        <form action = "admin_add.php" method = "POST" align="center">
            <a style="color:lightgoldenrodyellow; font-size:23px" >Add anime to Team PikaPika database</a><br><br><br>
            <a style="color:lightgoldenrodyellow; font-size:18px">title:</a><br>  
            <input type ="text" name ="add_title"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">genre:</a><br>  
            <input type ="text" name ="add_genre"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">rating:</a><br>  
            <input type ="text" name ="add_rating"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">season number:</a><br>
            <input type ="text" name ="add_season"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">status:</a><br>  
            <input type ="text" name ="add_a_status"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">start date: (yyyy-mm-dd)</a><br>  
            <input type ="text" name ="add_start_date"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">studio:</a><br>  
            <input type ="text" name ="add_studio"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">number of episodes:</a><br>  
            <input type ="text" name ="add_num_of_episodes"><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">add URL of image to go with anime:</a><br>  
            <input type ="text" name ="add_link" ><br><br>
            
            <a style="color:lightgoldenrodyellow; font-size:18px">description:</a><br>  
            <textarea name ="add_description" row="10" cols="60" style="width:400px; height:200px;"></textarea><br><br>
            
            <input type = "submit" value ="add">
            </form>
        
        <br><br><br><hr>
        
           <?php
            print("$output");
            ?>  
        <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        
        
    </body>

</html>
