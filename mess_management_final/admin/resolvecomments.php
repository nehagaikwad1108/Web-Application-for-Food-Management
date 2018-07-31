<?php 
require '../core.inc.php';
require '../connect.inc.php';
$id=$_POST['commentid'];

$sql="UPDATE `comments` SET Status='Resolved'  WHERE CommentID='$id'";
$result = mysql_query($sql);
header('Location:allcomments.php');
?>