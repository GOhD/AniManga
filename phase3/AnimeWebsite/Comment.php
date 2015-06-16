<!DOCTYPE html>
<?php
session_start();
$title="Animanga Forum";
$subtopic_topic = $_GET['subtopic'];
preg_match('/(\d+)(\D+)/', $subtopic_topic, $match);
$fid = $match[1];
$subtopic_title = $match[2];
$comment_list = array();
$current_useremail;
if(isset($_SESSION['useremail'])) {
  $current_useremail = $_SESSION['useremail'];
}
$info = $fid . $subtopic_title;

require "./Forum_globals.php";


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

          #comment_box {
               background-color:#CCCCFF;
               border-style:double;
               border-color:#0000FF;
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
            
            <div id="main">
              <center><h1><?php echo $subtopic_title;?></h1></center>
                <div>
                  <center>
                    <?php 
                      $comments = $mysqli->query("select msg,email,date_written
                                                  from comment_write_contain
                                                  where fid='$fid' and title='$subtopic_title'
                                                  order by date_written") or die($mysqli->error);
                      $comment_list = $comments->fetch_all(MYSQLI_ASSOC);
                      foreach ($comment_list as $comment) {
                        //echo '<pre>',print_r($subtopic_row),'</pre>';
                        echo "<div id='forum_content'><h3>",$comment['msg'],"</h3>
                              <p>-- ".$comment['email']."</p>
                              <p>on ".$comment['date_written']."</p></div>";
                      }
                    ?>
                  </center>
                </div>
                <?php
                  if(isset($_SESSION['useremail'])) {
                    echo '<div id="comment_box">
                            <center><h2>Enter a Comment!</h2></center>
                            <form action="Successful_Comment.php" method="post">
                             <input type="hidden" name="info" value="'.$info.'" />
                             <ul>
                               <li>
                                 <label for="comment">Comment:</label>
                                 <textarea name="comment" id="comment" cols="25" rows="3"></textarea>
                               </li>
                               <li>
                                 <input type="submit" value="submit" />
                                 <input type="reset" value="reset" />
                               </li>
                             </ul>
                           </form>
                         </div>';
                   }
                 ?>
            </div>
            
      
            
            <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        </div>
    </body>
</html>
