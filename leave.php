<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
require 'connect.inc.php';
$userid=@mysql_real_escape_string($_SESSION['loggedin']);
$query1="SELECT `key`,`book_no` FROM users WHERE `username`='$userid'";
if(mysql_query($query1))
{
	$run1=mysql_query($query1) or die(mysql_error());
	$row1=mysql_fetch_assoc($run1);
	
	$key=$row1['key'];
	$book_no=$row1['book_no'];

	$query2="UPDATE groups SET `number`=`number`-'$book_no' WHERE `key`='$key' ";
	$query3="UPDATE users SET `key`=0, `book_no`=0 WHERE `username`='$userid' ";
	$query4="SELECT `number` FROM groups WHERE `key`='$key'";
	$query5="INSERT INTO notification(`username`,`key`,`code`,`time`) VALUES('$userid','$key',0,NOW())";
	$query6="UPDATE users SET `notify`=`notify`+1 WHERE `key`='$key'";
	if(!mysql_query($query2) || !mysql_query($query3) || !mysql_query($query5) || !mysql_query($query6))
	{
		die('Error: '.mysql_error());
	}
	else
	{
		if($run=mysql_query($query4))
		{
			$row=mysql_fetch_assoc($run);
			if($row['number']==0)
			{
				$query5="DELETE FROM groups WHERE `key`='$key'";
				$query6="DELETE FROM notification WHERE `key`='$key'";
				if(!mysql_query($query5) || !mysql_query($query6))
				{
					die('Error: '.mysql_error());
				}
			}
		}
		$message = "Group Left successfully!";
		echo "<script type='text/javascript'>alert('$message');</script>";
     	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
	}
}
else{ echo 'could not connect';}
?>
