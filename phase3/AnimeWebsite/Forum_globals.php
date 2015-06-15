<?php
//phpinfo();
include "./Model/Credentials.php";

$content = array();

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

$user_comment_all;
$users_comment_all = $mysqli->query("select username 
                                     from member m
                                     where not exists (select fid
				                       from created_forum_forum f
				                       where not exists (select distinct fid
                                                                         from comment_write_contain c
                                                                         where m.email = c.email and f.fid = c.fid))") or die($mysqli->error);
$username_rows = $users_comment_all->fetch_all(MYSQLI_ASSOC);
for($i=0; $i < sizeof($username_rows); $i++) {
  //echo '<pre>',print_r($username_rows[$i]), '</pre>';
  $user_comment_all[$i] = $username_rows[$i]['username'];
}

?>
