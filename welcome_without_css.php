
<!DOCTYPE html> 
<html> 
<head>
 <title>
 	SHARE Ur FARE
 </title>
 	<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
  <style type="text/css"> 
  h1{color:teal;} 
  .id1{ color:goldenrod; font-size: 22px; } 
  .id1:hover{ color:gold; }
  .id2:hover{ color:indigo; } 
  .id3{ color:olivedrab; font-size: 22px; } 
  .id3:hover{ color:yellowgreen; } 
  .id4{ color:mediumslateblue; font-size: 22px; } 
  .id4:hover{ color:gold; } 
</style> 
</head> 
<body style="background-color:lavender;"> 
	<h1 style="text-align:Center;"><i><b><font class="id2"><ins>SHARE ur FARE</ins></font></b></i></h1> 
	<hr> 
	<font class="id1">Disclaimer:</font>
	<hr>
	<hr> 
	<p style="word-spacing: 3em;">
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Home</font></b></i></a>
		<a href="create_group1.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">CreateGroup</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Contacts</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Profile</font></b></i></a> 
		<a href="yourgroup.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">YourGroup</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3" style="word-spacing: 0.2em;">About us</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Help</font></b></i></a> 
		<a href="signout.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Signout</font></b></i></a></p> <hr> <hr> 
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
			<font class= "id4">Source: </font>
			<input type="text" name="source"><br><br> 
			<font class= "id4">Destination: </font>
			<input type="text" name="destination"><br><br> 
			<font class= "id4">Date: </font>
			<input type="date" name="date"><br><br> 
			<font class= "id4">Time: </font>
			<input type="time" name="time"><br><br> 
			<font class= "id4"><abbr title="Time variation in hours">Time variation: </abbr>
			</font>
			<input type="number" name="variation"><br><br>
			<font class= "id4"><abbr title="gender specification in sharing">Gender: </font>
			<input type="radio" name="gender" value="F">only female 
			<input type="radio" name="gender" value="M">only male 
			<input type="radio" name="gender" value="B">both <br><br> 
			<font class= "id4">Vehicle type: </font>
			<input type="text" name="vehicle"><br><br> 
			<font class= "id4"><abbr title="for whom u r booking">No. of people: </abbr></font>
			<input type="number" name="number"><br><br> <input type="submit" name="submit" value="Find Group"> 
		</form>
		
	</body> 
	</html>
