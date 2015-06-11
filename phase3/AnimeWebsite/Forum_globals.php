<?php
//phpinfo();
include "./Model/Credentials.php";

$mysqli = new mysqli('127.0.0.1', $user, 'F950308r', $database); 
if($mysqli->connect_errno) {
  die('Sorry the connection was not successful');
}

$main_forums = $mysqli->query("select fname from created_forum_forum") or die($mysqli->error);
$forum_rows = $main_forums->fetch_all(MYSQLI_ASSOC);

for($i=0; $i < sizeof($forum_rows); $i++) {
  $content[$i] = $forum_rows[$i]['fname'];
}



?>
