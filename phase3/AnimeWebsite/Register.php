<?php
require 'Model/Credentials.php';
//connection to the database
$db = mysqli_connect($host, $user, $passwd, $database)
        or die("Unable to connect to MySQL");
if (!empty($_POST)) {
    // Ensure that the user fills out fields 
    if (empty($_POST['username'])) {
        die("Please enter a username.");
    }
    if (empty($_POST['realname'])) {
        die("Please enter a realname.");
    }
    if (empty($_POST['password'])) {
        die("Please enter a password.");
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid E-Mail Address");
    }

    // Get the values from user input
    $username = $_POST['username'];
    $realname = $_POST['realname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username is already taken
    $dup_username1 = $db->query("Select * from Member where Username = '$username'") or die($db->error);
    $dup_username2 = $db->query("Select * from Admin where Admin_name = '$username'") or die($db->error);
    $count_dup_username1 = $dup_username1->num_rows;
    $count_dup_username2 = $dup_username2->num_rows;
    if (($count_dup_username1 > 0) || ($count_dup_username2 > 0)) {
        echo "<script type='text/javascript'> alert('Woops!This username is taken, please use another one!')</script>";
    };
    // Check if the email address is already taken
    $dup_email1 = $db->query("Select * from Member where Email = '$email'") or die($db->error);
    $dup_email2 = $db->query("Select * from Admin where Email = '$email'") or die($db->error);
    $count_dup_email1 = $dup_email1->num_rows;
    $count_dup_email2 = $dup_email2->num_rows;
    if (($count_dup_email1 > 0) || ($count_dup_email2 > 0)) {
        echo "<script type='text/javascript'> alert('Woops!This email address is taken, please use another one!')</script>";
    };



    // Add row to database , since Member is a child table from parent table User, it uses foreign key 
    // Therefore we need to first insert into User table
    $db->query("INSERT INTO Users ( 
                Email
            ) VALUES ( 
                '$email' 
            )") or die($db->error);

    $db->query("INSERT INTO Member ( 
                Email, 
                r_Name, 
                Username, 
                Password 
            ) VALUES ( 
                '$email', 
                '$realname', 
                '$username', 
                '$password' 
            )") or die($db->error);
    
    echo "<script type='text/javascript'> alert('Success!')</script>";


    // Security measures
}
?>






<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap Tutorial</title>
        <meta name="description" content="Bootstrap Tab + Fixed Sidebar Tutorial with HTML5 / CSS3 / JavaScript">
        <meta name="author" content="Untame.net">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="Styles/bootstrap.min.js"></script>
        <link href="Styles/bootstrap.min.css" rel="stylesheet" media="screen">
        <style type="text/css">
            // body { background: url(assets/bglight.png); }
            .hero-unit { background-color: #fff; }
            .center { display: block; margin: 0 auto; }
        </style>
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
                    <a class="brand">Become a member of Animanga Website!</a>
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li><a href="index.php">Return Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container hero-unit">
            <h1>Register</h1> <br /><br />
            <form action="register.php" method="post"> 
                <label>Email: <strong style="color:darkred;">*</strong></label> 
                <input type="text" name="email" value="" /> 
                <label>Username:</label> 
                <input type="text" name="username" value="" /> 
                <label>Realname:</label> 
                <input type="text" name="realname" value="" /> 
                <label>Password:</label> 
                <input type="password" name="password" value="" /> <br /><br />
                <p style="color:darkred;">* You may enter a false email address if desired. This demo database does not store addresses for purposes outside of this tutorial.</p><br />
                <input type="submit" class="btn btn-info" value="Register" /> 
            </form>
        </div>
