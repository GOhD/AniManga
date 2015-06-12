<?php


require ("Model/Credentials.php");
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
                
                    <a style="color:whitesmoke; font-size:25px" href="#">Login</a>
                    <a style="color:whitesmoke; font-size:25px" href="#">Register</a>
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
        </div>  
        <!--This part is for the search by genre for manga, we use the query for selection -->
        <form action ="Anime.php"   method ="post">
         <input type ="submit" name = "select" value = "search for the studio that produce >>">
         <br>
         <input type="radio" name="choice" id = "choose_max" value="max" >max
         <br>
         <input type="radio" name="choice" id = "choose_min" value="min">min
        </form> 
        
         
      <?php
      print("$output");
      ?>  
        
        
    </body>

</html>
