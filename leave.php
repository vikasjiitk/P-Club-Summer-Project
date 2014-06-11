<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
require 'connect.inc.php';
$userid=@mysql_real_escape_string($_SESSION['loggedin']);
$query1="SELECT `key`,`book_no` FROM users WHERE `id`='$userid'";
if(mysql_query($query1))
{
	$run1=mysql_query($query1) or die(mysql_error());
	$row1=mysql_fetch_assoc($run1);
	
	$key=$row1['key'];
	$book_no=$row1['book_no'];

	$query2="UPDATE groups SET `number`=`number`-'$book_no' WHERE `key`='$key' ";
	$query3="UPDATE users SET `key`=0, `book_no`=0 WHERE `id`='$userid' ";
	if(!mysql_query($query2) || !mysql_query($query3))
	{
		die('Error: '.mysql_error());
	}
	else
	{
		$message = "Group Left successfully!";
		echo "<script type='text/javascript'>alert('$message');</script>";
     	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
	}
}
else{ echo 'could not connect';}
?>
