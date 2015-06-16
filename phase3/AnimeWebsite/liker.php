<?php
$title = "Character";
require ("Entities/CharacterEntity.php");
require 'Model/Credentials.php';
if(isset($_GET['type'])){

    $cname=$_GET['type'];
}
  $output = '';
  //Open connection and Select database.
   
       $db = mysqli_connect($host, $user, $passwd, $database);
       
       if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
        }
                       
            $result = $db->query("UPDATE my_character SET rating=rating+1 where cname  LIKE '%$cname%'") or die($db->error);
            
            
               
        
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
                    <li><a href="Manga.php">Manga</a></li>
                    <li><a href="VoiceActor.php">VoiceActor</a></li>
                    <li><a href="Character.php"><strong>Character</strong></a></li>
                    <li><a href="Forum.php">Forum</a></li>
                </ul>
            </nav>
         
        <!--This part is for the search box -->
        <div id="content_area">
        <form action ="Character.php"   method ="post">
            
            <input type="text" name = "search" placeholder="search for character">
            <input type ="submit" value = ">>">
            
        </form>    
        
        
         
      <?php
      echo "Thank you for taking the time to like, ".$cname."'s rating has been updated!!!";
      ?>  
        </div>
         
        <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        </div>
    </body>

</html>
