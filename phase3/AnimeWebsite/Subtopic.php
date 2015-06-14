<!DOCTYPE html>
<?php
session_start();
$title="Animanga Forum";
$forum_topic = $_GET['topic'];
$topic_list = array();

require "./Forum_globals.php";

if(isset($_SESSION['useremail'])) {
  $current_useremail = $_SESSION['useremail'];
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

               

        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">   
               <?php if(isset($_SESSION['useremail'])) {
                        echo '<a style="color:whitesmoke; font-size:25px" href="Logout.php">Logout</a><br>
                              <a style="color:greenyellow; font-size:20px" >' . 'Welcome, ' . $_SESSION['username'].'</a>';
                     } else {
                        echo '<a style="color:whitesmoke; font-size:25px" href="Login.php">Login</a>
                              <a style="color:whitesmoke; font-size:25px" href="Register.php">Register</a>';
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
            
            <div id="main">
              <center><h1><?php echo $forum_topic;?></h1></center>
                <div>
                  <center>
                    <?php 
                      $topics = $mysqli->query("select s.fid,s.title,s.date_created,s.email
                                                from created_forum_forum c, subtopic_create_subtopic_have s
                                                where c.fid = s.fid and c.fname='$forum_topic'") or die($mysqli->error);
                      $subtopic_rows = $topics->fetch_all(MYSQLI_ASSOC);
                      foreach ($subtopic_rows as $subtopic_row) {
                        //echo '<pre>',print_r($subtopic_row),'</pre>';
                        $subtopic_fid = $subtopic_row['fid'];
                        $subtopic_title = $subtopic_row['title'];
                        $subtopic_author = $subtopic_row['email'];
                        $subtopic_date = $subtopic_row['date_created'];
                        $info = $subtopic_fid . $subtopic_title;
                        echo "<div id='forum_content'><a href=Comment.php?subtopic=",urlencode($info),">$subtopic_title</a></div><br>";
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
