<?php
$title = "Anime";
session_start();
require ("./Model/Credentials.php");
 $output = '';
  //Open connection and Select database.
   
       $db = mysqli_connect($host, $user, $passwd,$database);
       
       if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
        }
        
        if (isset($_POST['select'])){
            
            switch($_POST['choice']) {
                case "max":
                
                $result = $db->query("SELECT Studio, count(Studio) as totalcount
                                      from Anime group by Studio
                                      having count(Studio) = (
                                      select max(totalcount) as maxtotal
                                      from (select Studio, count(Studio) as totalcount
                                      from Anime group by Studio) as tmax)") or die($db->error);
                $count = $result->num_rows;
                echo 'yay, there are '.$count.' results that meet ur input!';
                while($row = mysqli_fetch_array($result)){
                $output .= 
                        "<table>
                        <tr>
                            <th>Studio: </th>
                            <td>$row[0]</td>
                        </tr>
                        
                        <tr>
                            <th>Count: </th>
                            <td>$row[1]</td>
                        </tr>
                        </table>";
                }
                break;
            
                
            
                case "min":
           
                $result = $db->query("SELECT Studio, count(Studio) as totalcount
                                      from Anime group by Studio
                                      having count(Studio) = (
                                      select min(totalcount) as mintotal
                                      from (select Studio, count(Studio) as totalcount
                                      from Anime group by Studio) as tmin)") or die($db->error);
                $count = $result->num_rows;
                echo 'yay, there are '.$count.' results that meet ur input!';
                while($row = mysqli_fetch_array($result)){
                $output .= 
                        "<table>
                        <tr>
                            <th>Studio: </th>
                            <td>$row[0]</td>
                        </tr>
                        
                        <tr>
                            <th>Count: </th>
                            <td>$row[1]</td>
                        </tr>
                        </table>";
                }
                break;
             
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
                    <li><a href="Anime.php"><strong>Anime</strong></a></li>
                    <li><a href="Manga.php">Manga</a></li>
                    <li><a href="VoiceActor.php">VoiceActor</a></li>
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="Forum.php">Forum</a></li>
                </ul>
            </nav>
          
        <!--This part is for the search by genre for manga, we use the query for selection -->
        <div id="content_area">
        <form action ="Anime.php"   method ="post">
         <input type ="submit" name = "select" value = "search for the studio that produce >>" size = "40">
         <br>
         <input type="radio" name="choice" id = "choose_max" value="max" >max
         <br>
         <input type="radio" name="choice" id = "choose_min" value="min">min
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
