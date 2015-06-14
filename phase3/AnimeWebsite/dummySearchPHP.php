<?php
$title = "Voice Actor";
require ("Entities/VoiceActorEntity.php");
require ("Model/Credentials.php");
  $output = '';
  //Open connection and Select database.
   
       $db = mysqli_connect($host, $user, $passwd, $database);
       
       if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
        }
      
            $result = $db->query(" SELECT Gender, count(Gender) as totalcount
                                    from voice_actor group by Gender
                                    having count(Gender) =(select max(totalcount) as maxtotal
                                    from (select Gender, count(Gender) as totalcount
                                    from voice_actor group by Gender) as tmax)") or die($db->error);
            
             $row = mysqli_fetch_array($result);
             $output= 'There are more ' . $row[0] . " Voice Actors". "<br>Total count: " . $row[1];
            
           
        
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
                
                    <a style="color:whitesmoke; font-size:25px" href="Login.php">Login</a>
                    <a style="color:whitesmoke; font-size:25px" href="Register.php">Register</a>
            </div>
 
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Anime.php">Anime</a></li>
                    <li><a href="Manga.php">Manga</a></li>
                    <li><a href="VoiceActor.php"><strong>VoiceActor</strong></a></li>
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="Forum.php">Forum</a></li>
                </ul>
            </nav>
         
        <!--This part is for the search box -->
        <div id="content_area">
        <form action ="VoiceActor.php"   method ="post">
            
            <input type="text" name = "search" placeholder="search for voice actor">
            <input type ="submit" value = ">>">
            
        </form>  
            
            <form action ="VoiceActor.php"   method ="post">
            <input type ="submit" value = "Find Max">
            
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
