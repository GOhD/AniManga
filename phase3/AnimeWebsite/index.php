<?php
$title = "Home";
include '/Model/Credentials.php';

//connection to the database
$dbhandle = mysql_connect($host, $user, $passwd) 
  or die("Unable to connect to MySQL");


//select a database to work with
$selected = mysql_select_db($database,$dbhandle) 
  or die("Could not select examples");
//query to check for a random Anime recommendation
$resultAnime = mysql_query("SELECT title,genre,rating from anime ORDER BY RAND() LIMIT 1");
//query to check for a random Manga recommendation
$resultManga = mysql_query("SELECT title,genre,description from manga ORDER BY RAND() LIMIT 1");
//query to check for a random Character recommendation
$resultCharacter = mysql_query("SELECT cname,description,rating from my_character ORDER BY RAND() LIMIT 1");

$string1;
$string2;
$string3;

//required to display the anime of the day section
                if ($resultAnime > 0) {
                    // output data of each row
                    while($row = mysql_fetch_array($resultAnime)) { 
                        $stringAnime='<HTML>
                                <h1>Anime Suggestion</h1>
                             </HTML>';
                       $animePicture=' <html>
                        <img src="Images/Anime/FullMetalAlchemist.jpg"  hspace="20">
                        </html><br>';
                    
                    $string1= "<font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . $row["genre"]. "<br><font color='green'>Rating</font>: " . $row["rating"]. "<br><br><br>";              
                    }}                                                                                                        
                        
                    if ($resultManga > 0) {
                    // output data of each row
                    while($row = mysql_fetch_array($resultManga)) { 
                        $stringManga='<HTML>
                                <h1>Manga Suggestion</h1>
                             </HTML>';
                       $mangaPicture=' <html>
                        <img src="Images/Anime/Naruto.jpg"  hspace="20">
                        </html><br>';
                    
                    $string2= "<font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . $row["genre"]. "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }}
                    
                    if ($resultCharacter > 0) {
                    // output data of each row
                    while($row = mysql_fetch_array($resultCharacter)) { 
                        $stringCharacter ='<HTML>
                                <h1>Manga Suggestion</h1>
                             </HTML>';
                       $characterPicture =' <html>
                        <img src="Images/Anime/Haruhi.jpg"  hspace="20">
                        </html><br>';
                    
                    $string3= "<font color='green'>Name</font>: " . $row["cname"]. "<br><font color='green'>rating</font>: " . $row["rating"]. "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }}
                    //formatting of final string to display
                    $string4= $stringAnime . $animePicture . $string1 . $stringManga . $mangaPicture . $string2 . $stringCharacter . $characterPicture . $string3;
                    $content = $string4;

//close the connection
mysql_close($dbhandle);

include 'Template.php';
?>
