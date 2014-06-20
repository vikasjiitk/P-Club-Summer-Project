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
&& ($_FILES["file"]["size"] < 80000000)
&& in_array($extension, $allowedExts)) {
  
 function findexts ($filename) 
 { 
 $filename = strtolower($filename) ; 
 $exts = split("[/\\.]", $filename) ; 
 $n = count($exts)-1; 
 $exts = $exts[$n]; 
 return $exts; 
 } 
 
 //This applies the function to our file  
 $ext = findexts ($_FILES['file']['name']) ; 
      $ran = rand () ;
       $ran2 = $ran.".";
 $target = "upload/";
  $target = $target . $ran2.$ext; 
     if(move_uploaded_file($_FILES["file"]["tmp_name"],
      $target))
     {
      echo "Stored in: " . $target;
    }
    else echo "Unable to upload due to some error";
      require 'connect.inc.php';
      $picc=$ran2.$ext;
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
      
   
} else {
  echo "Invalid file";
}
?>
