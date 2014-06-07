<!DOCTYPE html>
<html>
<head>
  <title>groups</title>
    <?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
</head>
<body><?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }
      $userid=$_POST['id'];
     $key=$_POST['group'];
    $sql="UPDATE users SET `key`= '$key' WHERE `id`='$userid'";
    if(!mysqli_query($con,$sql))
    {die('Error: '.mysqli_error($con));}
 		else{
    $message = "Group joined successfully!";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
  }
}
 ?>
</body></html>
