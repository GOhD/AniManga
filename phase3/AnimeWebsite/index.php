<?php
$title = "Home";
session_start();


include 'Model/Credentials.php';
//connection to the database
$dbhandle = mysqli_connect($host, $user, $passwd,$database) 


  or die("Unable to connect to MySQL");



//query to check for a random Anime recommendation

$resultAnime = mysqli_query($dbhandle,"SELECT title,genre,rating,description,season,a_status,start_date,studio,num_of_episodes,link from anime ORDER BY RAND() LIMIT 1");
//query to check for a random Manga recommendation
$resultManga = mysqli_query($dbhandle,"SELECT title,genre,description,rating,author,volume,published_date,link from manga ORDER BY RAND() LIMIT 1");
//query to check for a random Character recommendation
$resultCharacter = mysqli_query($dbhandle,"SELECT cname,description,rating,link from my_character ORDER BY RAND() LIMIT 1");



$string1;
$string2;
$string3;

//required to display the anime of the day section
                
                    // output data of each row
                    while($row = mysqli_fetch_array($resultAnime,MYSQLI_BOTH)) { 
                        $stringAnime='<HTML>
                                <h1>Anime Suggestion</h1>
                             </HTML>';
                        

                       $temp=$row["link"];

                    
                    $string1= "<img src=$temp style='width:225px;height:350px;'>" . "<br><font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . $row["genre"]. "<br><font color='green'>Rating</font>: " .
                            $row["rating"]. "<br><font color='green'>Season</font>: " . $row["season"] . "<br><font color='green'>Status</font>: " . $row["a_status"] 
                            ."<br><font color='green'>Start Date</font>: " . $row["start_date"]. "<br><font color='green'>Studio</font>: " . $row["studio"]."<br><font color='green'>Episodes</font>: " . 
                            $row["num_of_episodes"]."<br><font color='green'>Description</font>: " . $row["description"] . "<br><br><br>";              
                    }                                                                                                       
                        
                    
                    // output data of each row
                    while($row = mysqli_fetch_array($resultManga,MYSQLI_BOTH)) { 
                        $stringManga='<HTML>
                                <h1>Manga Suggestion</h1>
                             </HTML>';

                       $temp=$row["link"];


                    
                    $string2= "<img src=$temp style='width:225px;height:350px;'>" . "<br><font color='green'>Title</font>: " . $row["title"]. "<br><font color='green'>Genre</font>: " . 
                            $row["genre"]. "<br><font color='green'>Rating</font>: " . $row["rating"]. "<br><font color='green'>Author</font>: " . $row["author"].
                            "<br><font color='green'>Volume</font>: " . $row["volume"].
                            "<br><font color='green'>Publish Date</font>: " . $row["published_date"].
                            "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }
                    
                    
                    while($row = mysqli_fetch_array($resultCharacter,MYSQLI_BOTH)) { 
                        $stringCharacter ='<HTML>
                                <h1>Character Suggestion</h1>
                             </HTML>';

                       $temp=$row["link"];

                    
                    $string3="<img src=$temp style='width:225px;height:350px;'>" . "<br><font color='green'>Name</font>: " . $row["cname"]. "<br><font color='green'>rating</font>: " . $row["rating"].
                            "<br><font color='green'>Description</font>: " . $row["description"]. "<br><br><br>";      }
                    //formatting of final string to display
                    $string4= $stringAnime . $string1 . $stringManga . $string2 . $stringCharacter . $string3;
                    $content = $string4;

//close the connection
mysqli_close($dbhandle);

include 'Template.php';
?>
