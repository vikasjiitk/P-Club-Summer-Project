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
      $username=$_POST['username'];
      $book_no=$_POST['book_no'];
     $key=$_POST['group'];
    $sql="UPDATE users SET `key`= '$key',`book_no`='$book_no' WHERE `username`='$username'";
    $query="INSERT INTO notification(`username`,`key`,`code`,`time`) VALUES('$username','$key',1,NOW())";
    $query1="UPDATE users SET `notify`=`notify`+1 WHERE `key`='$key' and `username`!='$username'";
    $number=$_POST['number'];
    mysqli_query($con,"UPDATE groups SET `number`='$number' WHERE `key`=$key");
    if(!mysqli_query($con,$sql) || !mysqli_query($con,$query) || !mysqli_query($con,$query1))
    {die('Error: '.mysqli_error($con));}
  else{
    $message = "Group joined successfully!";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
  }
}
 ?>
</body></html>
