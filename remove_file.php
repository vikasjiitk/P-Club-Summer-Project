<?php
session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
 require 'connect.inc.php';
      $pic="";
      $usr=$_SESSION['loggedin'];
      $userid=@mysql_real_escape_string($usr);
$query="SELECT `gender`,`Photo` FROM users WHERE `username`='$usr'";
   if($sql1=mysql_query($query))
{

 $row=mysql_fetch_assoc($sql1);
  $pic=$row['Photo'];
  $file = "upload/".$pic;
if($file!="upload/m.jpg"&&$file!="f.jpg"){
if (!unlink($file))
  echo ("Error !!!!");
else
  echo ("Deleted $file");}
  if($row['gender']=='M')
    $pic="m.jpg";
  else
    $pic="f.jpg";
}
$query="UPDATE users SET `Photo`='$pic' WHERE `username`='$usr'";
   if(!mysql_query($query))
        echo 'could not connect';
     header("Location:profile.php"); 
      ?>
