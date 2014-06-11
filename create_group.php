<html>
<head>
  <title>Create Group</title>
  <style type="text/css">
  .align {text-align: center; color: blue;}
  .cen {text-align: center;}
  h1{color:teal;} 
  .id1{ color:goldenrod; font-size: 22px; } 
  .id1:hover{ color:gold; }
  .id2:hover{ color:indigo; } 
  .id3{ color:olivedrab; font-size: 22px; } 
  .id3:hover{ color:yellowgreen; } 
  .id4{ color:mediumslateblue; font-size: 22px; } 
  .id4:hover{ color:gold; } 
  </style>
  <?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
</head>
<body style="background-color:lavender";>
  <hr><hr>
<p style="word-spacing: 3em;">  
<a href="welcome.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Home</font></b></i></a>
<a href="create_group1.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">CreateGroup</font></b></i></a>
<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Contacts</font></b></i></a>
<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Profile</font></b></i></a>
<a href="yourgroup.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">YourGroup</font></b></i></a>
<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3" style="word-spacing: 0.2em;">About us</font></b></i></a>
<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Help</font></b></i></a>
<a href="login.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Signout</font></b></i></a></p> <hr> <hr>
<span class=align><h1><i>Create ur group</i></h1></span>
<span class=cen><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<font class= "id4"></font>
<input type="text" name="source"placeholder="Source: "><br><br>
<font class= "id4"></font>
<input type="text" name="destination"placeholder="Destination: "><br><br>
<font class= "id4"></font>
<input type="date" name="date"placeholder="Date: "><br><br>
<font class= "id4"> </font>
<input type="time" name="time"placeholder="Time:"><br><br>
<font class= "id4"><abbr title="">Gender specific: </abbr>
</font>
<input type="radio" name="gender" value="F">only female
<input type="radio" name="gender" value="M">only male
<input type="radio" name="gender" value="B">both<br><br>
<font class= "id4"></font>
<select name="vehicle">
<option value="AUTO">AUTO</option>
<option value="VIKRAM">VIKRAM</option>
<option value="ANY">ANY</option>
</select>
<br><br>
<font class= "id4"><abbr title="for whom you are booking"></abbr></font>
<input type="number" name="number"placeholder="No. of people: "><br><br>
<input type="number" name="limit"placeholder="Limit group to: "><br><br>
<input type="submit" name="submit" value="create group">
</form></sapn>
<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
  $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }
    $source=@mysqli_real_escape_string($con,$_POST["source"]);
    $destination=@mysqli_real_escape_string($con,$_POST["destination"]);
    $date=@mysqli_real_escape_string($con,$_POST["date"]);
    $time=@mysqli_real_escape_string($con,$_POST["time"]);
    $gender=@mysqli_real_escape_string($con,$_POST["gender"]);
    $vehicle=@mysqli_real_escape_string($con,$_POST["vehicle"]);
    $number=@mysqli_real_escape_string($con,$_POST["number"]);
    $limit=$_POST["limit"];
    if(empty($limit))
    {
      if($vehicle=='AUTO')
        $limit=3;
        else
        $limit=7;
    }
     $limit_no=@mysqli_real_escape_string($con,$limit);
    $sql="INSERT INTO groups (`source`, `destination`, `date`, `time`, `gender`, `vehicle`,`number`,`limit`)
VALUES('$source','$destination','$date','$time','$gender','$vehicle','$number','$limit_no')";
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
      $userid=@mysqli_real_escape_string($con,$_SESSION['loggedin']);
     $key=mysqli_insert_id($con);
    $sql1="UPDATE users SET `key`= '$key',`book_no`='$number' WHERE `id`='$userid' ";
      if(!mysqli_query($con,$sql1))
     {die('Error: '.mysqli_error($con));}
     echo '<br>' . "<h3>Welcome to share your fare</h3>" . '<br>';
     @mysqli_close($con);}
      ?>

</body>
