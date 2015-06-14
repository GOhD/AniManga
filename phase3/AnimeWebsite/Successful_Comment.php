<!DOCTYPE html>
<?php
session_start();
$title="Animanga Forum";
$current_useremail = $_SESSION['useremail'];
$subtopic_topic = $_POST['info'];
preg_match('/(\d+)(\D+)/', $subtopic_topic, $match);
$fid = $match[1];
$subtopic_title = $match[2];

require "./Forum_globals.php";

date_default_timezone_set('America/Vancouver');

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
                
                    <a style="color:whitesmoke; font-size:25px" href="Logout.php">Logout</a><br>
                    <a style="color:greenyellow; font-size:20px" ><?php echo'welcome, '.$_SESSION['username'];?></a>
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
              <?php
                $msg = $_POST['comment'];
                $current_date = getdate();
                $year = $current_date['year'];
                $month = $current_date['mon'];
                $day = $current_date['mday'];
                $date = $year . '-' . $month . '-' . $day;
                $insert_msg = $mysqli->query("insert into comment_write_contain 
                                              values (".$fid.",'".$subtopic_title."','".$msg."','".$date."','".$current_useremail."')");
                if($insert_msg){
                  echo '<center><h1>Comment Success!</h1></center>';
                }else{
                  die('Error : ('. $mysqli->errno .') '. $mysqli->error);
                }
              ?>
            </div>
            
            <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        </div>
    </body>
</html>
