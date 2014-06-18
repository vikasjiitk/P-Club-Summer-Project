<?php
session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 800000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    if (file_exists("upload/" . $_FILES["file"]["name"])) {
      echo $_FILES["file"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      require 'connect.inc.php';
      $picc=$_FILES['file']['name'];
      echo "<br>".$picc."<br>";
      $usr=$_SESSION['loggedin'];
      $userid=@mysql_real_escape_string($usr);
 $query="SELECT * FROM users WHERE `username`='$userid' ";
 if(mysql_query($query))
      {
      //echo 'success';
      $run=mysql_query($query) or die(mysql_error());
      $row=mysql_fetch_assoc($run);
      $cpic=$row["Photo"];
     }
if(strcmp($cpic, "m.jpg")!=0 && strcmp($cpic, "f.jpg")!=0)
  
$file = "upload/".$cpic;
if (!unlink($file))
  {
  echo ("Error !!!!");
  }
else
  {
  echo ("Deleted $file");
  }

      $query="UPDATE users SET `Photo`='$picc' WHERE `username`='$usr'";
      if(!mysql_query($query))
      {
      	echo 'could not connect';
      }
     header("Location:profile.php"); 
      
    }
  }
} else {
  echo "Invalid file";
}
?>
