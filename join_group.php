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
<a href="yourgroup.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">YourGroup</font></b></i></a>
<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3" style="word-spacing: 0.2em;">About us</font></b></i></a>
<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Help</font></b></i></a>
<a href="signout.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Signout</font></b></i></a></p> <hr> <hr>
<span class=align><h1>Group Members</h1></span>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $number=$_POST['number'];
  $book_no=$_POST['book_no'];
if($number>$_POST['limit'])
{
  $message = "Sorry! Cannot join.Group limit exceeded.";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
     exit;
}
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
echo '<span class =my>';
$i=1;
$sql1=mysql_query("SELECT gender FROM users WHERE `id`=$session");
$row_gen=mysql_fetch_assoc($sql1);
if(strcmp($row_gen['gender'],$_POST['gender'])!=0&&strcmp($_POST['gender'],"B")!=0)
{
$message = "Sorry!.Not allowed due to Gender conflicts.";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
     exit;
}
while($row_users=mysql_fetch_assoc($res_users))
{
echo $i.") ".$row_users['name']."(seats booked: ".$row_users['book_no'].")<br><br>";
  $i++;
}
echo "</span>";
echo "<form action='confirm_group.php' method='post'>" ."<input type='hidden' name='id' value='$session'>".
  "<input type='hidden' name='group' value='$key'>"."<input type='hidden' name='number' value='$number'>".
  "<input type='hidden' name='book_no' value='$book_no'>".
  "<input type='submit' name='confirm_group'value='Confirm Group'>"
."</form>";
}
 ?>
</body>
</html>
