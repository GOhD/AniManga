<?php
$title = "Home";
include '/Model/Credentials.php';

//connection to the database
$dbhandle = mysqli_connect($host, $user, $passwd,$database) 
  or die("Unable to connect to MySQL");



//query to check for a random Anime recommendation
$resultAnime = mysqli_query($dbhandle,"SELECT title,genre,rating from anime ORDER BY RAND() LIMIT 1");
//query to check for a random Manga recommendation
$resultManga = mysqli_query($dbhandle,"SELECT title,genre,description from manga ORDER BY RAND() LIMIT 1");
//query to check for a random Character recommendation
$resultCharacter = mysqli_query($dbhandle,"SELECT cname,description,rating from my_character ORDER BY RAND() LIMIT 1");

$string1;
$string2;
$string3;

//required to display the anime of the day section
                
                    // output data of each row
                    while($row = mysqli_fetch_array($resultAnime,MYSQLI_BOTH)) { 
                        $stringAnime='<HTML>
                                <h1>Anime Suggestion</h1>
                             </HTML>';
                       $animePicture=' <html>
                        <img src="Images/Anime/FullMetalAlchemist.jpg"  hspace="20">
                        </html><br>';
                    
                    $string1= "<font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . $row["genre"]. "<br><font color='green'>Rating</font>: " . $row["rating"]. "<br><br><br>";              
                    }                                                                                                       
                        
                    
                    // output data of each row
                    while($row = mysqli_fetch_array($resultManga,MYSQLI_BOTH)) { 
                        $stringManga='<HTML>
                                <h1>Manga Suggestion</h1>
                             </HTML>';
                       $mangaPicture=' <html>
                        <img src="Images/Anime/Naruto.jpg"  hspace="20">
                        </html><br>';
                    
                    $string2= "<font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . $row["genre"]. "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }
                    
                    
                    while($row = mysqli_fetch_array($resultCharacter,MYSQLI_BOTH)) { 
                        $stringCharacter ='<HTML>
                                <h1>Manga Suggestion</h1>
                             </HTML>';
                       $characterPicture =' <html>
                        <img src="Images/Anime/Haruhi.jpg"  hspace="20">
                        </html><br>';
                    
                    $string3= "<font color='green'>Name</font>: " . $row["cname"]. "<br><font color='green'>rating</font>: " . $row["rating"]. "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }
                    //formatting of final string to display
                    $string4= $stringAnime . $animePicture . $string1 . $stringManga . $mangaPicture . $string2 . $stringCharacter . $characterPicture . $string3;
                    $content = $string4;

//close the connection
mysqli_close($dbhandle);

include 'Template.php';
?>
