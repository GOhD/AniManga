<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="Styles/bootstrap.min.js"></script>
        <link href="Styles/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand">Welcome to Animanga Website!</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li><a href="register.php">Register</a></li>
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
                                <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                    <form action="index.php" method="post"> 
                                        Username:<br /> 
                                        <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
                                        <br /><br /> 
                                        Password:<br /> 
                                        <input type="password" name="password" value="" /> 
                                        <br /><br /> 
                                        <input type="submit" class="btn btn-info" value="Login" /> 
                                    </form> 
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="wrapper">
            <div id="banner">   




                
                <a style="color:whitesmoke; font-size:25px" href="Login.php">Login</a>
                    <a style="color:whitesmoke; font-size:25px" href="#">Register</a>

            </div>


            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Anime.php">Anime</a></li>
                    <li><a href="Manga.php">Manga</a></li>
                    <li><a href="VoiceActor.php">VoiceActor</a></li>
                    <li><a href="Character.php">Character</a></li>
                    <li><a href="Forum.php">Forum</a></li>
                </ul>
            </nav>

            <div id="content_area">




                <?php echo $content; ?>  

            </div>



            <footer>
                <p style="color:whitesmoke;">Created by team Pikapika</p>
            </footer>
        </div>
    </body>
</html>
