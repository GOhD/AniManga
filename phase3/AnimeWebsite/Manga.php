<?php
session_start();
$title = "Manga";
require ("Entities/MangaEntity.php");
require ("Model/Credentials.php");
$output = '';
//Open connection and Select database.

$db = mysqli_connect($host, $user, $passwd, $database);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if (isset($_POST['search_genre'])) {
    $term = $_POST['search_genre'];

    //echo gettype($term);
    if ((is_numeric($term)) | (is_bool($term))) {
        echo "Please enter type string for searching!";
    }

    $result = $db->query("SELECT * FROM Manga where Genre LIKE '%$term%'") or die($db->error);
    $count1 = $db->query("SELECT count(*) from Manga where genre like '%$term%'") or die($db->error);
    $newrow = mysqli_fetch_array($count1);

    echo 'yay, there are ' . $newrow[0] . ' results that meet ur input!';

    if ($result->num_rows) {

        while ($row = mysqli_fetch_array($result)) {
            $title = $row[0];
            $genre = $row[1];
            $rating = $row[2];
            $description = $row[3];
            $author = $row[4];
            $volume = $row[5];
            $published_date = $row[6];
            $link = $row[7];

            // echo $img;

            $manga = new MangaEntity($title, $genre, $rating, $description, $author, $volume, $published_date, $link);

            $output .=
                    "<table class = 'mangaTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img  src ='$manga->link' /></th>
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
    } else {
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
              <?php if(isset($_SESSION['useremail'])) {
                       echo '<a style="color:lightblue; font-size:25px" href="Logout.php">Logout</a><br>
                             <a style="color:greenyellow; font-size:20px" >' . 'Welcome, ' . $_SESSION['username'].'</a>';
                    } else {
                       echo '<a style="color:lightblue; font-size:25px" href="Login.php">Login</a>
                             <a style="color:lightblue; font-size:25px" href="Register.php">Register</a>';
                    }
              ?>
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
          
        <!--This part is for the search by genre for manga, we use the query for selection -->
        <!--This part is for the search box -->
        <div id="content_area">
            <form action ="Manga.php"   method ="post">
                <input type="text" name = "search_genre" placeholder="search for genre of manga" size = "40" width="20">
                <input type ="submit" value = ">>">
            </form>    



         <?php
         print("$output");
         ?>  
        </div>

    

    <footer>
        <p style="color:whitesmoke;">Created by team Pikapika</p>
    </footer>
</div>


</body>

</html>
