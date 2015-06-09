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
            </div>
            
            
                    <a style="color:maroon" href="#">Login</a>
                    <a style="color:maroon" href="#">Register</a>
              
             
            
           
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Coffee.php">Anime</a></li>
                    <li><a href="#">Manga</a></li>
                    <li><a href="#">Forum</a></li>
                    <li><a href="#">VoiceActor</a></li>
                </ul>
            </nav>
            
            <div id="content_area">
                <?php echo $content; ?>
            </div>
            
      
            
            <footer>
                <p>Created by team Pikapika</p>
            </footer>
        </div>
    </body>
</html>
