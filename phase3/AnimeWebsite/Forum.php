<!DOCTYPE html>
<?php
session_start();
$title="Animanga Forum";

require "./Forum_globals.php";

if(isset($_SESSION['useremail'])) {
  $current_useremail = $_SESSION['useremail'];
}
$selected;
if(isset($_POST['selected'])) {
  $selected = $_POST['selected'];
}

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
        <style type="text/css">
          #main {
               background-color:#66CCFF;
               color:#000;
               font-family:"Tahoma";
               padding:1px;
               border-style:inset;
               border-color:#00FF00;
               border-width:5px;
          }

          #forum_content {
               background-color:#99FF99;
               color:#000;
               font-family:Arial;
               font-size:20pt;
               border-style:solid;
               border-color:#0000FF;
               border-width:5px;
               padding:5px;
          }

          #button {
               background-color:#FFCCFF;
               padding:5px;
               border-style:inset;
               border-width:10px;
               border-color:#00CCFF;
          }
               

        </style>
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
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="Forum.php"><strong>Forum</strong></a></li>
                </ul>
            </nav>
            
            <div id="button">
              <form action="Forum.php" method="post">
                <input type="submit" name="selected" value="Click to see which members has commented in every forum!">
              </form>
              <?php
                if(isset($_POST['selected'])) {
                  echo "<h2><center>Here are the users that commented in every forum</center></h2>";
                  foreach($user_comment_all as $username) {
                    echo '<center>'.$username.'</center><br>';
                  }
                }
              ?>
            </div>
            
            <div id="main">
              <center><h1>Main Forum</h1></center>
                <div>
                  <center>
                    <?php 
                      foreach ($content as $subtopic) {
                        $forum_name = $subtopic['fName'];
                        $forum_creator = $subtopic['Admin_name'];
                        $date = $subtopic['Date_created'];
                        echo "<div id='forum_content'><a href=Subtopic.php?topic=",urlencode($forum_name),">$forum_name</a><br>
                              <p>Created by - ".$forum_creator." on ".$date."</p></div>";
                      }
                    ?>
                  </center>
                </div>
            </div>
            
      
            
            <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        </div>
    </body>
</html>
