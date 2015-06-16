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
        $link = $row[9];
        
        $anime = new AnimeEntity($title, $genre, $rating, $description, $season, $a_status, $start_date,$studio,$num_of_episode, $link);

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
                
                <a style="color:lightblue; font-size:25px" href="logout.php">Logout</a><br>
                    <a style="color:greenyellow; font-size:20px" ><strong><?php echo'welcome, '.$_SESSION['username'];?></strong></a>
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
        <div id="content_area">
        <a align="center" style="color:lightcyan; font-size:24px"><strong>Admin Main</strong></a><br><br>
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_del.php">Delete Anime</a><br><br>
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_add.php">Add Anime</a><br><br>
        <a align="center" style="color:lightsteelblue; font-size:22px" href="admin_upd.php">Update Anime</a><br><br>
        </div>
        
           <?php
            print("$output");
            ?>  
        <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        
    </body>

</html>