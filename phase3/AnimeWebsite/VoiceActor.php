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
        if (isset($_POST['search'])){
            $term = $_POST['search'];
            //if (!is_string($_POST['search'])){
                //echo gettype($term);
            //'Invalid input type,please enter in a string!';
            //}
            $result = $db->query("SELECT * FROM voice_actor where vname  LIKE '%$term%'") or die($db->error);
            $count = $result->num_rows;
            if ($result->num_rows){
            //echo 'yay, there are '.$count.' results that meet ur input!';
            while($row = mysqli_fetch_array($result)){
                $vname = $row[0];
                $birthday = $row[1];
                $gender = $row[2];
                $biography = $row[3];
                $voiceActor = new VoiceActorEntity($birthday, $gender, $biography, $vname);
                
                $output .="<table class = 'mangaTable'> 
                            <tr>
                            <th rowspan='6' width = '150px' >                                                    
                        </tr>
                        <tr>
                            <th>Name: </th>
                            <td>$voiceActor->vname</td>
                        </tr>
                        
                        <tr>
                            <th>Gender: </th>
                            <td>$voiceActor->gender</td>
                        </tr>   
                        
                        <tr>
                            <th>Birthday: </th>
                            <td>$voiceActor->birthday</td>
                        </tr>                        
                     
                        <tr>
                            <td colspan='6' >$voiceActor->biography</td>
                        </tr> 
                        
                        </table>";
                   
            }
            }
            else{
                $output= 'There is no result that satisfy your input!';
            }   
        }
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
                
                    <a style="color:whitesmoke; font-size:25px" href="login.php">Login</a>
                    <a style="color:whitesmoke; font-size:25px" href="#">Register</a>
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
