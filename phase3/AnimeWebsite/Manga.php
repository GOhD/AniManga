<?php

require ("Entities/MangaEntity.php");
require ("Model/Credentials.php");
 // $output = '';
  //Open connection and Select database.
   
       $db = mysqli_connect($host, $user, $passwd, $database);
       
       if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
        }
        if (isset($_POST['search_genre'])){
            $term = $_POST['search_genre'];
            //if (!is_string($_POST['search_genre'])){
                echo gettype($term);
            //'Invalid input type,please enter in a string!';
            //}
            $result = $db->query("SELECT * FROM Manga where Genre LIKE '%$term%'") or die($db->error);
            $count = $result->num_rows;
            if ($result->num_rows){
            echo 'yay, there are '.$count.' results that meet ur input!';
            while($row = mysqli_fetch_array($result)){
                $title = $row[0];
                $genre = $row[1];
                $rating = $row[2];
                $description = $row[3];
                $author= $row[4];
                $volume = $row[5];
                $published_date = $row[6];
                $img = $row[7];
                
                // echo $img;
            
                $manga = new MangaEntity($title, $genre, $rating, $description, $author, $volume, $published_date,$img);
               
                $output .= 
                        "<table class = 'mangaTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img  src ='$manga->img' /></th>
                            <th width = '75px' >Title: </th>
                            <td> $manga->title</td>
                        </tr>
                        
                     
                        <tr>
                            <th>Genre: </th>
                            <td>$manga->genre</td>
                        </tr>
                        
                        <tr>
                            <th>Author: </th>
                            <td>$manga->author</td>
                        </tr>
                        
                     
                        <tr>
                            <th>Rating: </th>
                            <td>$manga->rating</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$manga->description</td>
                        </tr>                      
                     </table>";
                   
            }
            }
            else{
                echo 'There is no result that satisfy your input!';
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
                
                    <a style="color:whitesmoke; font-size:25px" href="#">Login</a>
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
        <!--This part is for the search by genre for manga, we use the query for selection -->
        <form action ="Manga.php"   method ="post">
            <input type="text" name = "search_genre" placeholder="search for genre of manga">
            <input type ="submit" value = ">>">
        </form>    
        
        
         
      <?php
      print("$output");
      ?>  
        
        
    </body>

</html>
