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
                    <li><a href="Coffee.php">Anime</a></li>
                    <li><a href="#">Manga</a></li>
                    <li><a href="VoiceActor.php">VoiceActor</a></li>
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="#">Forum</a></li>
                </ul>
            </nav>
            
            <div id="content_area">
                
                <?php
                //required to display the anime of the day section
                if ($resultAnime > 0) {
                    // output data of each row
                    while($row = mysql_fetch_array($resultAnime)) { 
                        ECHO'<HTML>
                                <h1>Anime Suggestion</h1>
                             </HTML>';
                       echo' <html>
                        <img src="Images/Anime/FullMetalAlchemist.jpg"  hspace="20">
                        </html><br>';
                    
                    echo "<font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . $row["genre"]. "<br><font color='green'>Rating</font>: " . $row["rating"]. "<br><br><br>";              
                    }}                                                                                                        
                        
                    if ($resultManga > 0) {
                    // output data of each row
                    while($row = mysql_fetch_array($resultManga)) { 
                        ECHO'<HTML>
                                <h1>Manga Suggestion</h1>
                             </HTML>';
                       echo' <html>
                        <img src="Images/Anime/Naruto.jpg"  hspace="20">
                        </html><br>';
                    
                    echo "<font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . $row["genre"]. "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }}
                    
                    if ($resultCharacter > 0) {
                    // output data of each row
                    while($row = mysql_fetch_array($resultCharacter)) { 
                        ECHO'<HTML>
                                <h1>Manga Suggestion</h1>
                             </HTML>';
                       echo' <html>
                        <img src="Images/Anime/Haruhi.jpg"  hspace="20">
                        </html><br>';
                    
                    echo "<font color='green'>Name</font>: " . $row["cname"]. "<br><font color='green'>rating</font>: " . $row["rating"]. "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }}
                    
                ?>
            </div>
            
      
            
            <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        </div>
    </body>
</html>
