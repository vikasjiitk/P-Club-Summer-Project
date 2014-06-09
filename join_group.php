<html>
<head>
  <title>groups</title>
    <?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
$session=$_SESSION['loggedin'];
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
  .my{color: red; font-size: 15pt;}
  .align{text-align: center; color: blue;}
  </style>
</head>
<body style="background-color:lavender;">
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
    <a href="signout.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Signout</font></b></i></a></p> <hr> <hr> 
  <span class=align><h1>Group Members</h1></span> 
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$connect=mysql_connect("localhost","root","pcp10");
if(!$connect)
{
  die("Failed to connect: " . mysql_error());
}
if(!mysql_select_db("iitk")){
die("Failed to select DB:" .mysql_error());
}
$key=$_POST['group'];
$res_users=mysql_query("SELECT * FROM users WHERE `key`=$key");
while($row_users=mysql_fetch_assoc($res_users))
{
	echo '<h3 class=align text-align:center>'.$row_users['name'].'</h3>';
}
echo '<br><br>';
echo "<form action='confirm_group.php' method='post'>" ."<input type='hidden' name='id' value='$session'>".
  "<input type='hidden' name='group' value='$key'>"."<input type='submit' name='confirm_group'value='Confirm Group'>"
."</form>";
}
 ?>

</body>
</html>
