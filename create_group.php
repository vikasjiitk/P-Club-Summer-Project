<html>
<head>
	<title>Create Group</title>
	<style type="text/css">
	h1{color:teal;} 
	.align {text-align: center; color: blue;}
	.cen {text-align: center;}
	.id1{ color:goldenrod; font-size: 22px; } 
  .id1:hover{ color:gold; }
  .id2:hover{ color:indigo; } 
  .id3{ color:olivedrab; font-size: 22px; } 
  .id3:hover{ color:yellowgreen; } 
  .id4{ color:mediumslateblue; font-size: 22px; } 
  .id4:hover{ color:gold; }  
	</style>
</head>
<body style="background-color:lavender";>
<h1 style="text-align:Center;"><i><b><font class="id2"><ins>SHARE ur FARE</ins></font></b></i></h1> 
	<hr> 
	<font class="id1">Disclaimer:</font>
	<hr>
	<hr> 
	<p style="word-spacing: 3em;">
		<a href="welcome.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Home</font></b></i></a>
		<a href="create_group.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">CreateGroup</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Contacts</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Profile</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Notifications</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3" style="word-spacing: 0.2em;">About us</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Help</font></b></i></a> 
		<a href="login.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Signout</font></b></i></a></p> <hr> <hr> 
	<span class=align><h1><i>Create ur group</i></h1></span>
	<span class=cen><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
			<font class= "id4">Source: </font>
			<input type="text" name="source"><br><br> 
			<font class= "id4">Destination: </font>
			<input type="text" name="destination"><br><br>
			<font class= "id4">Date: </font>
			<input type="date" name="date"><br><br> 
			<font class= "id4">Time: </font>
			<input type="time" name="time"><br><br> 
			<font class= "id4"><abbr title="">Gender specific: </abbr>
			</font>
			<input type="radio" name="gender" value="F">only female
			<input type="radio" name="gender" value="M">only male
			<input type="radio" name="gender" value="B">both<br><br>
			<font class= "id4">Vehicle type: </font>
			<input type="text" name="vehicle"><br><br> 
			<font class= "id4"><abbr title="for whom ypu are booking">No. of people: </abbr></font>
			<input type="number" name="number"><br><br> <input type="submit" name="submit" value="create group"> 
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
    $sql="INSERT INTO groups (`source`, `destination`, `date`, `time`, `gender`, `vehicle`,`number`)
     VALUES('$source','$destination','$date','$time','$gender','$vehicle','$number')";
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}

     echo '<br>' . "<h3>Welcome to share your fare</h3>" . '<br>';

     //echo "<a href=login.php>Go to Login Page</a>";

      @mysqli_close($con);}
      ?>

</body>
