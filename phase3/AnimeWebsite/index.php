<?php
$title = "Home";
$username = "root@localhost";
$password = "";
$database = "test";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
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
//close the connection
mysql_close($dbhandle);



/**$content = '
       
        <h1>Anime Of The Day</h1>
         <div ><img src="Images/Anime/FullMetalAlchemist.jpg"  hspace="20"><br>
        <FONT COLOR="Maroon">Name:</FONT> Mikako Takahashi<br>
        <FONT COLOR="Maroon">Birthday:</FONT> May 29 1980<br>
        <FONT COLOR="Maroon">Gender:</FONT> Female<br>
        <FONT COLOR="Maroon">Description:</FONT> Mikako Takahashi born May 29, 1980 in Chiba Prefecture is a Japanese voice actress and J-pop singer. As the Excel Saga character Mikako Hyatt, she forms one half of the voice acting duo The Excel Girls She is employed by Im Enterprise. <br>    
            </div>
            
        <h1>Manga Of The Day</h1>
         <div><img src="Images/Anime/Naruto.jpg"  hspace="20"><br>
        <FONT COLOR="Maroon">Title:</FONT> Mikako Takahashi<br>
        <FONT COLOR="Maroon">Genre:</FONT> Fighting and stuff<br>
        <FONT COLOR="Maroon">Rating:</FONT> 5<br>
        <FONT COLOR="Maroon">Season:</FONT> 18<br>
        <FONT COLOR="Maroon">Status:</FONT> Airing<br>
        <FONT COLOR="Maroon">Start Date:</FONT> 11-11-111111<br>
        <FONT COLOR="Maroon">Episodes:</FONT> 456<br>
        <FONT COLOR="Maroon">Studio:</FONT> Viz Media<br>
        <FONT COLOR="Maroon">Description:</FONT> Naruto Uzumaki, a hyperactive and knuckle-headed ninja, lives in Konohagakure, the Hidden Leaf village. Moments prior to his birth, a huge demon known as the Kyuubi, the Nine-tailed Fox, attacked Konohagakure and wreaked havoc. In order to put an end to the Kyuubis rampage, the leader of the village, the 4th Hokage, sacrificed his life and sealed the monstrous beast inside the newborn Naruto. <br>    
            </div>        
        
        <h1>Character Of The Day</h1>
        <div><img src="Images/Anime/Haruhi.jpg" hspace="20"><br>
        <FONT COLOR="Maroon">Title:</FONT> Haruhi<br>
        <FONT COLOR="Maroon">Rating:</FONT> 5<br>
        <FONT COLOR="Maroon">Description:</FONT> Haruhi Suzumiya, a first year student at North High School , and second year  can be characterized as funny, eccentric, and somewhat unpredictable. In the series, she is introduced declaring her interests in aliens, espers and time travelers and does not care for ordinary human beings. The last thing on her mind is a normal high school life. With a burning desire to find such phenomena in the world, she is generally unapproachable and finds ordinary people boring and uninteresting. As a result of this, many of her classmates choose to avoid and confront her. She deals with her emotions by creating a parallel universe, where she inadvertently releases transparent creatures who tear up and destroy everything that comes into contact with them. Espers are the ones who can stop these creatures by cutting and destroying them, because if these creatures are left alone destroying everything as well as the outer barrier it could affect the outside world. She also likes to dress up Mikuru in random outfits. <br>    
            </div>
         
         
            ';**/
include 'Template.php';
?>
