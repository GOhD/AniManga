<?php
//phpinfo();
include "./Model/Credentials.php";

$content = array();
$current_fid;
$current_subtopic;

$mysqli = new mysqli($host, $user, $passwd, $database); 
if($mysqli->connect_errno) {
  die('Sorry the connection was not successful');
}

$main_forums = $mysqli->query("select * from created_forum_forum") or die($mysqli->error);
$forum_rows = $main_forums->fetch_all(MYSQLI_ASSOC);

for($i=0; $i < sizeof($forum_rows); $i++) {
  //echo '<pre>',print_r($forum_rows[$i]), '</pre>';
  $content[$i] = $forum_rows[$i]['fName'];
}


?>
